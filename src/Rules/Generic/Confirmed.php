<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Confirmed extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'confirmed';

  /**
   * @property string
   */
  protected static string $errorMessage = "fields '%s' and '%s' don't match!";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]))
      throw new WrongDefinedRuleException("'Confirmed' rule takes exactly 1 argument");


    if ($this->value !== $this->data[$this->args[0]]) $this->addError($this->field, $this->args[0]);

    parent::handle();
  }
}
