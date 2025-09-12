<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Date\Before;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;


class BeforeTest extends TestCase
{

  public function testHandle(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    $mockValidator = $this->createMock(Validator::class);
    $mockValidator
      ->expects($this->once())
      ->method('addError')
      ->with($field = 'date', "date should be before: dateToCompareWith");

    (new Before(
      $mockValidator,
      $field,
      "2025-10-02",
      ["dateToCompareWith" => "2025-10-02"],
      ["dateToCompareWith"]))->handle();

    (new Before($mockValidator, $field = 'date', [], []))->handle();
  }
}
