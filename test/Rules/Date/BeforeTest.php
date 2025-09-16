<?php

namespace NightCommit\PHP\Sanity\Test\Rules\Date;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\Date\Before;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class BeforeTest extends BaseRuleTestCase
{
  public function testHandleIfRuleParamterIsNotDefined(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new Before($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfDateIsNotBeforeTheComparableDate(): void
  {
    $rule = new Before(
      $this->validatorMock,
      $this->field,
      $this->value= "2025-10-02",
      $this->data = ["dateToCompareWith" => "2025-10-02"],
      $this->args = ["dateToCompareWith"]
    );

    $this->expectsAddErrorToBeCalled([
      $this->field, sprintf($rule->getErrorMessage(), $this->args[0])
    ]);

    $rule->handle();
  }
}
