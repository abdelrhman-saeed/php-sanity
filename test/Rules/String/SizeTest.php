<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\String\Size;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


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
