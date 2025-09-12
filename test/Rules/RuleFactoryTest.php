<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Rules\RuleFactory;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\TestCase;

class RuleFactoryTest extends TestCase
{
  public function testRegister(): void
  {

    RuleFactory::register($name = "testName", $class = "ANonExistingClass");

    $this->assertEquals($class, RuleFactory::getRule($name));
    $this->assertNull(RuleFactory::getRule('ANonExistingClassName'));
  }

  public function testCheckUserDefinedRules(): void
  {
    $rules    = ['string', 'min:10', 'max:20', 'in:1,2,3'];
    $expected = [

      ['name' => 'string',  'args' => ['']],
      ['name' => 'min',     'args' => ['10']],
      ['name' => 'max',     'args' => ['20']],
      ['name' => 'in',      'args' => ['1', '2', '3']],
    ];

    RuleFactory::checkUserDefinedRules($rules);
    $this->assertEquals($expected, $rules);

    $nonExistingRules = ['quack'];

    $this->expectException(WrongDefinedRuleException::class);
    RuleFactory::checkUserDefinedRules($nonExistingRules);
  }

  public function testMake(): void
  {
    $data = $value = [];
    $rule = ['name' => 'string', 'args' => []];

    $mockValidator = $this->createMock(Validator::class);

    $this->expectException(\LogicException::class);

    RuleFactory::make($mockValidator, 'field', $value, $rules = [], $data);

    $this->assertInstanceOf(
      Rule::class,
      RuleFactory::make($mockValidator, 'field', $value, $data, $rule['args']));
  }
}
