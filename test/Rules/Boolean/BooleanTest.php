<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Boolean;

use NightCommit\PHP\Sanity\Rules\Boolean\Boolean;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class BooleanTest extends BaseRuleTestCase
{

  public function testHandleWhenCastIsSet(): void
  {
    $rule = new Boolean(
      $this->validatorMock,
      $this->field,
      $this->value = true,
      $this->data,
      $this->args = ['cast']
    );

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }

  public function testHandleWhenCastIsNotSet(): void
  {
    $rule = new Boolean($this->validatorMock, $this->field, $this->value = "yes", $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
