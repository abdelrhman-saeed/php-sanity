<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Date\After;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;


class AfterTest extends TestCase
{

  public function testHandle(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    $mockValidator = $this->createMock(Validator::class);
    $mockValidator
      ->expects($this->once())
      ->method('addError')
      ->with($field = 'date', "date should be after: dateToCompareWith");

    (new After(
      $mockValidator,
      $field,
      "2025-10-02",
      ["dateToCompareWith" => "2025-10-03"],
      ["dateToCompareWith"]))->handle();

    (new After($mockValidator, $field = 'date', [], []))->handle();
  }
}
