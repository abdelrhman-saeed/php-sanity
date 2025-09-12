<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Rules\Float;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Float\Floats;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FloatsTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private string $field;

  protected function setUp(): void
  {

    $this->validatorMock = $this->createMock(Validator::class);
    $this->field = 'field';
  }

  public function testHandleIfValueIsNotFloat(): void
  {

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, 'should be float');

    (new Floats($this->validatorMock, $this->field, "non-float", []))
      ->handle();
  }

  public function testHandleIfDefinedPercisionParamterIsNotNumeric(): void
  {

    $this->expectException(WrongDefinedRuleException::class);

    (new Floats($this->validatorMock, $this->field, 0.00, [], ['non-numeric']))
      ->handle();
  }

  public function testHandleIfFloatPercisionIsNotLikeDefinedPercisionParamter(): void
  {
    $floatPercision = 3;

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, "the float percision should be {$floatPercision}");

    (new Floats($this->validatorMock, $this->field, 0.1111, [], [$floatPercision]))
      ->handle();
  }
}
