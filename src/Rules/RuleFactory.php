<?php

namespace NightCommit\PHP\Sanity\Rules;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Validator;
use NightCommit\PHP\Sanity\Rules\{

  Rule, //Interface

  #Generics
  Generic\Filled,
  Generic\Callback,
  Generic\Required,
  Generic\Confirmed,
  Generic\In,
  Generic\Nullable,

  #Integer
  Int\Integer,

  #Float
  Float\Floats,
  Float\Percision,

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
    'confirmed'         => Confirmed::class,
    'in'                => In::class,
    'nullable'          => Nullable::class,

    #String
    'string'            => Str::class,
    'size'              => Size::class,
    'min'               => Min::class,
    'max'               => Max::class,
    'email'             => Email::class,
    'regex'             => Regex::class,

    #Int
    'int'               => Integer::class,

    #Float
    'float'             => Floats::class,
    'percision'         => Percision::class,

    #Numeric
    'less'              => Less::class,
    'more'              => More::class,
    'unsigned'          => Unsigned::class,

    #Boolean
    'boolean'           => Boolean::class,

    #Array
    'array'             => Arr::class,
    'array_length'      => ArrLength::class,
    'array_unique'      => ArrUnique::class,

    #DateTime
    'date'              => Date::class,
    'after'             => After::class,
    'before'            => Before::class,

    #FileUpload
    'file'              => File::class,
    'ftype'             => FType::class,
    'fsize'             => FSize::class,
  ];

  public static function register(string $name, string|callable $action): void
  {
    self::$ruleMap[$name] = $action;
  }

  public static function getRule(string $name): ?string
  {
    return self::$ruleMap[$name] ?? null;
  }

  private static function setupUserDefinedRuleForInstantiating(string &$rule): void
  {
    $rule = explode(':', $rule);
    $rule = [
      'name' => $rule[0],
      'args' => isset($rule[1]) ? explode(',', $rule[1]) : [],
    ];
  }

  public static function checkUserDefinedRules(array &$rules): void
  {
    foreach ($rules as &$rule)
    {
      self::setupUserDefinedRuleForInstantiating($rule);

      if (! array_key_exists($rule['name'], self::$ruleMap))
        throw new WrongDefinedRuleException("the defined rule '{$rule['name']}' is unsupported!");
    }
  }

  private static function instantiateRule(string|callable $ruleAction, mixed ...$args): Rule
  {
    return is_callable($ruleAction)
      ? (new Callback(...$args))->setCallable($ruleAction) : new $ruleAction(...$args);
  }

  public static function make(Validator $validator, string $field, mixed &$value, array $rules, array &$data): Rule
  {
    if (empty($rules))
      throw new \LogicException("No rules defined for field '{$field}'");

    $rule = array_shift($rules);
    $ruleAction = self::$ruleMap[$rule['name']];

    /** @var Rule */
    $head = $current = self::instantiateRule($ruleAction, $validator, $field, $value, $data, $rule['args']);

    foreach ($rules as $rule)
    {
      $current = $current
        ->setNext(self::instantiateRule(self::$ruleMap[$rule['name']], $validator, $field, $value, $data, $rule['args']));
    }

    return $head;
  }
}
