<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\In;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class InTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private string $field = 'field';

  protected function setUp(): void
  {

    $this->validatorMock = $this->createMock(Validator::class);
  }

  public function testHandleIfSpecifiedValuesAreNotSet(): void
  {

    $this->expectException(WrongDefinedRuleException::class);

    (new In($this->validatorMock, $this->field, null, []))
      ->handle();
  }

  public function testHandleIfValueNotInSpecifiedValues(): void
  {
    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, "value must be one of the specified values!");

    (new In($this->validatorMock, $this->field, 'value', [], ['val1', 'val2']))
      ->handle();
  }
}
