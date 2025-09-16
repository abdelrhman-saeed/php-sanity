<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Rules\Float;

use NightCommit\PHP\Sanity\Rules\Float\Floats;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class FloatsTest extends BaseRuleTestCase
{
  public function testHandleIfValueIsNotFloat(): void
  {
    $rule = new Floats($this->validatorMock, $this->field, "non-float", $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);

    $rule->handle();
  }
}
