<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Array\ArrLength;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;
use AbdelrhmanSaeed\PHP\Sanity\Validator;

class ArrLengthTest extends BaseRuleTestCase
{

  public function testHandleIfRuleParamterIsNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new ArrLength(
      $this->validatorMock,
      $this->field,
      $this->value = [],
      $this->data,
      $this->args = ["non-numeric-value"])
    )->handle();
  }

  public function testHandleIfArrayLengthIsNotLikeTheDefinedParamter(): void
  {
    $rule = new ArrLength(
      $this->validatorMock,
      $this->field,
      $this->value = [],
      $this->data,
      $this->args = [3]
    );

    $this->expectsAddErrorToBeCalled([$this->field, sprintf($rule->getErrorMessage(), $this->args[0])]);
    $rule->handle();
  }
}
