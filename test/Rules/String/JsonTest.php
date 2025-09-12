<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\String\Json;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class JsonTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $this->value = 'non-json-format';

    $this->expectsAddErrorToBeCalled([$this->field, 'invalid json format']);

    (new Json($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }
}
