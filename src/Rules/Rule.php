<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;

use AbdelrhmanSaeed\PHP\Validator\Validator;

abstract class Rule
{
  public function __construct(protected Validator $validator, protected string $field, protected mixed $value) {}

  protected function addError(string $error): void
  {
    $this->validator->addError($this->field, $error);
  }
}
