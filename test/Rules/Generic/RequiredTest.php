<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Generic\Required;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;

class RequiredTest extends BaseRuleTestCase
{
  public function testHandle(): void
  {
    $rule = new Required($this->validatorMock, $this->field, $this->value, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
