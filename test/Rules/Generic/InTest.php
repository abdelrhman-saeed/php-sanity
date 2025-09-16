<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Generic;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Generic\In;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class InTest extends BaseRuleTestCase
{
  public function testHandleIfSpecifiedValuesAreNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new In($this->validatorMock, $this->field, null, []))->handle();
  }

  public function testHandleIfValueNotInSpecifiedValues(): void
  {
    $rule = new In(
      $this->validatorMock,
      $this->field,
      $this->value = 'value',
      $this->data,
      $this->args = ['value-1', 'value-2']
    );

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
