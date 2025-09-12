<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Validator;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Callback extends Rule
{
  public function __construct(

    private   $callable,
    protected Validator $validator,
    protected string    $field,
    protected mixed     $value,
    protected array     &$data
  ) {}

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    $callbackParamters = (new \ReflectionFunction($this->callable))
      ->getParameters();

    $errorMessage = $callbackParamters[0];

    if (! $errorMessage->isDefaultValueAvailable()) {
      throw new WrongDefinedRuleException(
        'the callback error message first argument should have a default value!'
      );
    }

    $errorMessage = $errorMessage->getDefaultValue();

    ($result = ($this->callable)($errorMessage, $this->value))
      ?: $this->validator->addError($this->field, $errorMessage);

    // continue validation if this callback validation passed
    $continueValidation = true;

    if (isset($callbackParamters[1]) && $callbackParamters[1]->isDefaultValueAvailable()) {

      $continueValidation =
        (bool) $callbackParamters[1]->getDefaultValue();
    }

    if ($result && $continueValidation) parent::handle();
  }
}
