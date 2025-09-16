<?php

namespace NightCommit\PHP\d\PHP\Sanity\Test\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Generic\Filled;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class FilledTest extends BaseRuleTestCase
{
  public function testHandle(): void
  {
    $rule = new Filled($this->validatorMock, $this->field, null, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
