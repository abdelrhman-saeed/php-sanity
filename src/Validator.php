<?php

namespace NightCommit\PHP\Sanity;

use NightCommit\PHP\Sanity\{
  Rules\RuleFactory, ValidatedDataBuilder, FieldExtractor
};


abstract class Validator
{
  protected array $validated    = [];
  protected array $errors       = [];
  public static array $messages = [];


  public function __construct(protected array $data)
  {
    $this->validate($this->rules(), fn(string $field, mixed $value) =>
        ValidatedDataBuilder::build($field, $value, $this->validated, $this->errors));

    $this->validate($this->files());
  }

  public function validate(array $rules, ?callable $action = null): void
  {
    foreach ($rules as $path => &$userDefinedRules)
    {
      $fields = [];

      RuleFactory::checkUserDefinedRules($userDefinedRules);
      FieldExtractor::extract(explode('.', $path), $this->all(), $fields);

      foreach ($fields as $field => $value)
      {
        RuleFactory::make($this, $field, $value, $userDefinedRules, $this->data)
          ->handle();

        if (! is_null($action)) $action($field, $value);
      }
    }
  }


  /**
   * defines the request validation rules
   *
   * @return <string, string[]>
   */
  protected function rules(): array { return []; }

  /**
   * defines the request validation file rules
   *
   * @return <string, string[]>
   */
  protected function files(): array { return []; }

  /**
   * returns the validated data
   *
   * @return <string, mixed>
   */
  public function validated(): array { return $this->validated; }

  /**
   * returns all data
   *
   * @return <string, mixed>
   */
  public function all(): array { return $this->data; }

  /**
   * returns the error messages of the data
   * that didn't pass the validation
   *
   * @return <string, T>
   */
  public function errors(): array
  {
    return $this->errors;
  }

  /**
    param string $field
    param string $error
    
   * @return void
   */
  public function addError(string $field, string $error): void
  {
    $this->errors[$field] ??= [];
    $this->errors[$field][] = $error;
  }
}
