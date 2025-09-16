<?php

namespace NightCommit\PHP\Sanity\Test\Rules\String;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\String\Min;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class MinTest extends BaseRuleTestCase
{

  public function testHandleIfMinParamterIsNotSet(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Min($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfValueLengthExceedsTheLimit(): void
  {
    $this->args = [3]; // length limit

    $errorMessage = "value length should be more than {$this->args[0]}";

    $this->expectsAddErrorToBeCalled([$this->field, $errorMessage]);

    (new Min(
      $this->validatorMock,
      $this->field,
      $this->value = "",
      $this->data,
      $this->args)
    )->handle();
  }
}
