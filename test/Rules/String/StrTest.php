<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\String\Str;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class StrTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {

    $this->expectsAddErrorToBeCalled([$this->field, 'should be string']);

    (new Str($this->validatorMock, $this->field, $this->value = null, $this->data))
      ->handle();
  }
}
