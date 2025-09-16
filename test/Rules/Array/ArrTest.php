<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Array;

use NightCommit\PHP\Sanity\Rules\Array\Arr;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class ArrTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $rule = new Arr($this->validatorMock, $this->field, $this->value, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, sprintf($rule->getErrorMessage())]);
    $rule->handle();
  }
}
