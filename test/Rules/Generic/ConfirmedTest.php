<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Rules\Generic;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Generic\Confirmed;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class ConfirmedTest extends BaseRuleTestCase
{
  public function testHandleIfConfirmationParamterIsNotDefined(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Confirmed($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfComparisionValueDoesNotMatch(): void
  {
    $rule = new Confirmed(
      $this->validatorMock,
      $this->field,
      $this->value = "value",
      $this->data = [$this->args[] = "comparisionField" => "non-equal-value"],
      $this->args
    );

    $this->expectsAddErrorToBeCalled([
      $this->field, sprintf($rule->getErrorMessage(), $this->field, $this->args[0])
    ]);

    $rule->handle();
  }
}
