<?php

namespace AbdelrhmanSaeed\PHP\d\PHP\Sanity\Test\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\Filled;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FilledTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private string $field; 


  protected function setUp(): void
  {
    $this->validatorMock = $this->createMock(Validator::class);
    $this->field = 'field';
  }

  public function testHandle(): void
  {

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, 'should not be empty');

    (new Filled($this->validatorMock, $this->field, null, []))
      ->handle();
  }

}
