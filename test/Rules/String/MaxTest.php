<?php

namespace NightCommit\PHP\Sanity\Test\Rules\String;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\String\Max;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class MaxTest extends BaseRuleTestCase
{

  protected function setUp(): void
  {
    $this->args = [3];
    parent::setUp();
  }

  public function testHandleIfMaxParamterIsNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Max($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfValueLengthExceedsTheLimit(): void
  {
    $errorMessage = "value length should be less than {$this->args[0]}";

    $this->expectsAddErrorToBeCalled([$this->field, $errorMessage]);

    (new Max(
      $this->validatorMock,
      $this->field,
      $this->value = "1111",
      $this->data,
      $this->args)
    )->handle();
  }
}
