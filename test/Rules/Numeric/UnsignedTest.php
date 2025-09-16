<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Numeric;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Numeric\Unsigned;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class UnsignedTest extends BaseRuleTestCase
{

  public function testHandleIfValueIsNotLessThanComparableParamter(): void
  {
    $this->expectsAddErrorToBeCalled([$this->field, "should be unsigned"]);

    (new Unsigned($this->validatorMock, $this->field, $this->value = -1, $this->data, $this->args))
      ->handle();
  }
}


