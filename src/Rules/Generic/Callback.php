<?php

namespace NightCommit\PHP\Sanity\Rules\Generic;

use NightCommit\PHP\Sanity\Validator;
use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Callback extends Rule
{
  private $callable;

  public function setCallable(callable $callble): self
  {
    $this->callable = $callble;
    return $this;
  }

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

    // continue validation if this callback validation passed
    $continueValidation = true;

    if (isset($callbackParamters[1]) && $callbackParamters[1]->isDefaultValueAvailable()) {

      $continueValidation =
        (bool) $callbackParamters[1]->getDefaultValue();
    }

    ($this->callable)($errorMessage, $continueValidation, $this->value)
      ?: $this->validator->addError($this->field, $errorMessage);

    if ($continueValidation) parent::handle();
  }
}
