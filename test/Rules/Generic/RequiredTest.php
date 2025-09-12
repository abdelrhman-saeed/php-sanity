<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\Required;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RequiredTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private string $field = 'field';

  protected function setUp(): void
  {

    $this->validatorMock = $this->createMock(Validator::class);
  }

  public function testHandle(): void
  {

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, 'required');

    (new Required($this->validatorMock, $this->field, null, []))
      ->handle();
  }
}
