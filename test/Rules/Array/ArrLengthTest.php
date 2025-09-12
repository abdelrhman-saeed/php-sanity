<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use PHPUnit\Framework\TestCase;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Array\ArrLength;
use AbdelrhmanSaeed\PHP\Sanity\Validator;

class ArrLengthTest extends TestCase
{

  public function testHandle(): void
  {
    $mockValidator  = $this->createMock(Validator::class);
    $errorMessage   = 'array length should be';

    $field  = 'name';
    $value  = 1;
    $data   = [$value];
    $args   = [$value];

    $this->expectException(WrongDefinedRuleException::class);

    (new ArrLength($mockValidator, $field, null, [], ["non-numeric-value"]))
      ->handle();

    $mockValidator->expects($this->once())
      ->method('addError')
      ->with($field, $errorMessage);

    (new ArrLength($mockValidator, $field, $value, $data, $args))
      ->handle();
  }
}
