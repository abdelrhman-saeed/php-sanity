<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Boolean;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Boolean\Boolean;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class BooleanTest extends TestCase
{

  private MockObject|Validator $mockValidator;
  private string $field = 'check';


  protected function setUp(): void
  {

    $this->mockValidator = $this->createMock(Validator::class);
  }

  public function testHandleWhenCastIsSet(): void
  {
    $this
        ->mockValidator
        ->expects($this->once())
        ->method('addError')
        ->with($this->field, "should be 'yes' or 'no'.");

    (new Boolean($this->mockValidator, $this->field, true, [], ['cast']))
      ->handle();
  }

  public function testHandleWhenCastIsNotSet(): void
  {
    $this
        ->mockValidator
        ->expects($this->once())
        ->method('addError')
        ->with($this->field, "should be boolean");

    (new Boolean($this->mockValidator, $this->field, "yes", []))
      ->handle();
  }
}
