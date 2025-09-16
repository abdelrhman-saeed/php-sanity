<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Int;

use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;
use NightCommit\PHP\Sanity\Rules\Int\Integer;


class IntegerTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $rule = new Integer($this->validatorMock, $this->field, $this->value, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
