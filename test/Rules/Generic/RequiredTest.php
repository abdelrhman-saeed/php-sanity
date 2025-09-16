<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\Required;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;

class RequiredTest extends BaseRuleTestCase
{
  public function testHandle(): void
  {
    $rule = new Required($this->validatorMock, $this->field, $this->value, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
