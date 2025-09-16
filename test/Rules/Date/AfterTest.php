<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Date\After;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class AfterTest extends BaseRuleTestCase
{
  public function testHandleIfRuleParamterIsNotDefined(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new After($this->validatorMock, $this->field, $this->value, $this->data))
      ->handle();
  }

  public function testHandleIfDateIsNotAfterTheComparableDate(): void 
  {
    $rule = new After(
      $this->validatorMock,
      $this->field,
      $this->value = "2025-10-02",
      $this->data = ["dateToCompareWith" => "2025-10-02"],
      $this->args = ["dateToCompareWith"]
    );

    $this->expectsAddErrorToBeCalled([
      $this->field, sprintf( $rule->getErrorMessage(), $this->args[0] )
    ]);

    $rule->handle();
  }
}
