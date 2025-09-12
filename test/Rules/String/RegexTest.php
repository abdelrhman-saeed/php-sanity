<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\String\Regex;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class RegexTest extends BaseRuleTestCase
{

  public function testHandleIfRuleParameterIsNotSet(): void
  {

    $this->expectException(WrongDefinedRuleException::class);

    (new Regex($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfRegexDoesNotMatch(): void
  {

    $this->expectsAddErrorToBeCalled([
      $this->field, 'the value does not match the specified format'
    ]);

    (new Regex($this->validatorMock, $this->field, $this->value = '123', [], ['alpha']))
      ->handle();
  }
}
