<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Array\ArrUnique;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class ArrUnqiueTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $rule = new ArrUnique($this->validatorMock, $this->field, $this->value = [1,1], $this->data);

    $this->expectsAddErrorToBeCalled([$this->field, $rule->getErrorMessage()]);

    $rule->handle();
  }
}
