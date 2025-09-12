<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules;

use AbdelrhmanSaeed\PHP\Validator\Rules\RuleFactory;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
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

    $rules = [
      'name' =>               ['required', 'string', 'min:10'],
      'data.users.*.name' =>  ['required', 'string', 'max:10']
    ];

    // ($ruleFactoryMock = Mockery::mock('alias:' . 'RuleFactory'))
    // ->shouldReceive('checkUserDefinedRules')
    // ->with(
    // $this->callback(fn ($arg) => $arg === $rules['name']),
    // $this->callback(fn ($arg) => is_callable($arg))
    // );


    $mockValidator = $this->getMockBuilder(Validator::class)
      ->onlyMethods(['validate'])
      ->disableOriginalConstructor()
      // ->setConstructorArgs(['data' => ['users' => [['name' => 'abdelrhman']]] ])
      ->getMock();

    $mockValidator->expects($this->exactly(2))->method('validate');

    ($validatorReflection = new \ReflectionClass(Validator::class))
      ->getConstructor()
      ->invoke($mockValidator, $data);

    // $mockValidator->expects($this->once())->method('rules')->willReturn($rules);
    // $mockValidator->expects($this->exactly(2))->method('validate');
    // $mockValidator->__construct($data);
  }
}
