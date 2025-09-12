<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Numeric;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Numeric\Less;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;

class LessTest extends BaseRuleTestCase
{

  protected function setUp(): void
  {
    $this->args = [1];
    $this->value = 2;

    parent::setUp();
  }

  public function testHandleIfComparableParamterIsNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Less($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfValueIsNotLessThanComparableParamter(): void
  {
    $this->expectsAddErrorToBeCalled([
      $this->field, "should be less than {$this->args[0]}"
    ]);

    (new Less($this->validatorMock, $this->field, $this->value, $this->data, $this->args))
      ->handle();
  }
}


