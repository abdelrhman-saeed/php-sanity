<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Date\Date;
use AbdelrhmanSaeed\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class DateTest extends BaseRuleTestCase
{

  public function testHandle(): void
  {
    $this
      ->validatorMock
      ->expects($this->exactly(2))
      ->method('addError')
      ->willReturnCallback(function (...$args): void {

        static $call = 0;
        static $expectedArgs = [
          [$this->field, "invalid date format: Y-m-d"],
          [$this->field, "invalid date format: d/m/y"]
        ];

        $this->assertSame($expectedArgs[$call++], $args);
      });

    /**
     * addError method get called because it's an invalid date format
     * the Default format Y-m-d
     */
    (new Date($this->validatorMock, $this->field, "non-date-format", []))->handle();

    /**
     * addError method get called because it's an invalid date format
     */
    (new Date($this->validatorMock, $this->field, "2025-10-5", [], ['d/m/y']))->handle();
  }
}
