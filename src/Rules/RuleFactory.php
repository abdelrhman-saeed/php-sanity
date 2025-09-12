<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use AbdelrhmanSaeed\PHP\Sanity\Rules\{

  Rule, //Interface

  #Generics
  Generic\Filled,
  Generic\Required,
  Generic\Confirmed,
  Generic\In,

  #Integer
  Int\Integer,

  #Float
  Float\Floats,

  #Boolean
  Boolean\Boolean,

  #string
  String\Str,
  String\Max,
  String\Min,
  String\Size,
  String\Email,
  String\Regex,

  #Array
  Array\Arr,
  Array\ArrLength,
  Array\ArrUnique,

  #Numeric
  Numeric\Equal,
  Numeric\Less,
  Numeric\More,
  Numeric\Unsigned,

  #DateTime
  Date\Date,
  Date\After,
  Date\Before,

  #FileUpload
  File\File,
  File\FSize,
  File\FType,
};


class RuleFactory
{
  private static array $ruleMap = [

    #Generics
    'required'          => Required::class,
    'filled'            => Filled::class,

    #String
    'string'            => Str::class,
    'size'              => Size::class,
    'min'               => Min::class,
    'max'               => Max::class,
    'email'             => Email::class,
    'regex'             => Regex::class,
    'confirmed'         => Confirmed::class,
    'in'                => In::class,

    #Int
    'int'               => Integer::class,

    #Float
    'float'             => Floats::class,

    #Numeric
    'equal'             => Equal::class,
    'less'              => Less::class,
    'more'              => More::class,
    'unsigned'          => Unsigned::class,

    #Boolean
    'boolean'           => Boolean::class,

    #Array
    'array'             => Arr::class,
    'len'               => ArrLength::class,
    'array_unique'      => ArrUnique::class,

    #DateTime
    'date'              => Date::class,
    'after'             => After::class,
    'before'            => Before::class,

    #FileUpload
    'file'              => File::class,
    'file_type'         => FType::class,
    'file_size'         => FSize::class,
  ];

  public static function register(string $name, string $class): void
  {
    SELF::$ruleMap[$name] = $class;
  }

  public static function getRule(string $name): ?string
  {
    return self::$ruleMap[$name] ?? null;
  }

  public static function checkUserDefinedRules(array &$rules): void
  {
    foreach ($rules as &$rule) {

      $rule = explode(':', $rule);
      $rule = ['name' => $rule[0], 'args' => explode(',', $rule[1] ?? '')];

      if (! array_key_exists($rule['name'], SELF::$ruleMap))
        throw new WrongDefinedRuleException("the defined rule '{$rule['name']}' is unsupported!");
    }
  }

  public static function make(Validator $validator, string $field, mixed &$value, array $rules, array &$data): Rule
  {
    if (empty($rules))
      throw new \LogicException("No rules defined for field '{$field}'");

    $rule       = array_shift($rules);
    $ruleClass  = SELF::$ruleMap[$rule['name']];

    /** @var Rule */
    $head = $current = new $ruleClass($validator, $field, $value, $data, $rule['args']);

    foreach ($rules as $rule) {

      $ruleClass  = SELF::$ruleMap[$rule['name']];
      $current    = $current->setNext(new $ruleClass($validator, $field, $value, $data, $rule['args']));
    }

    return $head;
  }
}
