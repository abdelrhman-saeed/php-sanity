<?php

namespace NightCommit\PHP\Sanity\Test\Rules\String;

use NightCommit\PHP\Sanity\Rules\String\Email;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class EmailTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $this->value = 'non-email-format';

    $this->expectsAddErrorToBeCalled([$this->field, 'invalid email format']);

    (new Email($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }
}
