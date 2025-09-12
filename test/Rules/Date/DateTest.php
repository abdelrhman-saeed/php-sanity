<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Date\Date;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;


class DateTest extends TestCase
{

  public function testHandle(): void
  {
    $mockValidator = $this->createMock(Validator::class);
    $field = 'date';

    $mockValidator->expects($this->exactly(2))
      ->method('addError')
      ->willReturnCallback(function (...$args) use ($field) {

        static $call = 0;

        $expectedArgs = [
          [$field, "invalid date format: Y-m-d"],
          [$field, "invalid date format: d/m/y"]
        ];

        $this->assertSame($expectedArgs[$call++], $args);
      });

    /**
     * addError method get called because it's an invalid date format
     * the Default format Y-m-d
     */
    (new Date($mockValidator, $field, "non-date-format", []))->handle();

    /**
     * addError method get called because it's an invalid date format
     */
    (new Date($mockValidator, $field, "2025-10-5", [], ['d/m/y']))->handle();
  }
}
