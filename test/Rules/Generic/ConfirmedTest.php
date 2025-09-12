<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\Confirmed;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ConfirmedTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private string $comparisionField;
  private string $field = 'field';


  protected function setUp(): void
  {

    $this->validatorMock = $this->createMock(Validator::class);
    $this->comparisionField = 'anotherField';
  } 

  public function testHandleIfConfirmationParamterIsNotDefined(): void
  {

    $this->expectException(WrongDefinedRuleException::class);

    (new Confirmed($this->validatorMock, $this->field, null, []))
      ->handle();
  }

  public function testHandleIfComparisionValueDoesNotMatch(): void
  {

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, "fields '{$this->field}' and '{$this->comparisionField}' don't match!");

    (new Confirmed($this->validatorMock, $this->field, "value",
      [$this->comparisionField => "non-equal-val"], [$this->comparisionField]))
    ->handle();
  }
}
