<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Array\ArrUnique;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;

class ArrUnqiueTest extends TestCase
{

  public function testHandle(): void
  {
    ($mockValidator = $this->createMock(Validator::class))
        ->expects($this->once())
        ->method('addError')
        ->with($field = 'name', 'array items should be unqiue');

    (new ArrUnique($mockValidator, $field, [1,2,3,3,4], []))->handle();
  }
}
