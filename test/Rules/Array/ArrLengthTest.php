<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Array;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Array\ArrLength;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


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
