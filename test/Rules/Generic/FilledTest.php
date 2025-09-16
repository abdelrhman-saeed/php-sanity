<?php

namespace AbdelrhmanSaeed\PHP\d\PHP\Sanity\Test\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Generic\Filled;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class FilledTest extends BaseRuleTestCase
{
  public function testHandle(): void
  {
    $rule = new Filled($this->validatorMock, $this->field, null, $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);
    $rule->handle();
  }
}
