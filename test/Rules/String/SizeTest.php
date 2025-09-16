<?php

namespace NightCommit\PHP\Sanity\Test\Rules\String;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\String\Size;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class SizeTest extends BaseRuleTestCase
{

  public function testHandleIfRuleParamterIsNotSet(): void
  {

    $this->expectException(WrongDefinedRuleException::class);

    (new Size($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfLengthSizeExceedsSizeLimit(): void
  {

    $this->args = [$size = 3];

    $this->expectsAddErrorToBeCalled([
      $this->field,
      "the field length should be {$size}"
    ]);

    (new Size($this->validatorMock, $this->field, $this->value = '', $this->data, $this->args))
      ->handle();
  }
}
