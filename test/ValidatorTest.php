<?php

namespace NightCommit\PHP\Sanity\Test\Rules;

use NightCommit\PHP\Validator\Rules\RuleFactory;
use NightCommit\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;
use Mockery;

class ValidatorTest extends TestCase
{

  protected function tearDown(): void
  {
    Mockery::close();
  }

  public function testValidate(): void
  {

    $data = [
      'name' => 'abdelrhman',
      'data' => ['users' => [['name' => 'abdelrhman']]]
    ];


    $mockValidator = $this->getMockBuilder(Validator::class)
      ->onlyMethods(['validate'])
      ->disableOriginalConstructor()
      ->getMock();

    $mockValidator->expects($this->exactly(2))->method('validate');

    (new \ReflectionClass(Validator::class))
      ->getConstructor()
      ->invoke($mockValidator, $data);
  }
}
