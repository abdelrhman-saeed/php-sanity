<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Rules\Float;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Float\Floats;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class FloatsTest extends BaseRuleTestCase
{
  public function testHandleIfValueIsNotFloat(): void
  {
    $rule = new Floats($this->validatorMock, $this->field, "non-float", $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);

    $rule->handle();
  }
}
