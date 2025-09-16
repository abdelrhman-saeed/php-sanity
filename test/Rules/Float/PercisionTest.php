<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Rules\Float;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Float\Floats;
use NightCommit\PHP\Sanity\Rules\Float\Percision;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class PercisionTest extends BaseRuleTestCase
{
  public function testHandleIfDefinedPercisionParamterIsNotNumeric(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Percision(
      $this->validatorMock,
      $this->field,
      0.00,
      $this->data,
      ['non-numeric'])
    )->handle();
  }

  // i am really bad in naming thing so don't judge me
  public function testIfPerscisionIsNotLikePercisionParamter(): void
  {
    $this->args = [3];

    $rule = new Percision(
      $this->validatorMock,
      $this->field,
      0.1111,
      $this->data,
      $this->args
    );

    $this->expectsAddErrorToBeCalled([
      $this->field, sprintf($rule->getErrorMessage(), $this->args[0])
    ]);

    $rule->handle();

  }
}
