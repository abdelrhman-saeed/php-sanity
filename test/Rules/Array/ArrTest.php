<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Array\Arr;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{

  public function testHandle(): void
  {
    $mockValidator = $this->createMock(Validator::class);
    $mockValidator
        ->expects($this->once())
        ->method('addError')
        ->with($field = 'name', 'should be an array');

    (new Arr($mockValidator, $field, null, []))->handle();
  }
}
