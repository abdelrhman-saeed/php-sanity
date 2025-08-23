<?php

namespace AbdelrhmanSaeed\PHP\Validator;

use AbdelrhmanSaeed\PHP\Validator\Rules\GenericRules;


abstract class Validator
{
  protected mixed $currentInput;
  protected array $errors = [];


  public function __construct(protected array $data)
  {
    $this->rules();
  }

  public function addError(string $name, string $error): void
  {
    $this->errors[$name][] = $error;
  }

  /**
   * defines the request validation rules
   *
   * @return void
   */
  abstract protected function rules(): void;

  /**
   * specifies the request field to validate on
   *
   * @return GenericRules
   */
  protected function input(string $name): GenericRules
  {
    return new GenericRules($this, $name, $this->data[$name] ?? null);
  }

  /**
   * returns the validated data
   *
   * @return <string,T>
   */
  public function getData(): array
  {
    return $this->data;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }
}
