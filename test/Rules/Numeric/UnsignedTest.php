<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Numeric;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Numeric\Unsigned;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;

class UnsignedTest extends BaseRuleTestCase
{

  public function testHandleIfValueIsNotLessThanComparableParamter(): void
  {
    $this->expectsAddErrorToBeCalled([$this->field, "should be unsigned"]);

    (new Unsigned($this->validatorMock, $this->field, $this->value = -1, $this->data, $this->args))
      ->handle();
  }
}


