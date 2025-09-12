<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Numeric;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Numeric\More;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;

class MoreTest extends BaseRuleTestCase
{

  protected function setUp(): void
  {
    $this->args = [2];
    $this->value = 1;

    parent::setUp();
  }

  public function testHandleIfComparableParamterIsNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new More($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfValueIsNotLessThanComparableParamter(): void
  {
    $this->expectsAddErrorToBeCalled([
      $this->field, "should be more than {$this->args[0]}"
    ]);

    (new More($this->validatorMock, $this->field, $this->value, $this->data, $this->args))
      ->handle();
  }
}


