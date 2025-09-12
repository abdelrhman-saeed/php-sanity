<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Int;

use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Int\Integer;


class IntegerTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, 'should be integer');

    (new Integer($this->validatorMock, $this->field, null, $this->data))
      ->handle();
  }
}
