<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Max extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'max';

  /**
   * @property string
   */
  protected static string $errorMessage = "value length should be less than %d";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]) || ! is_numeric($this->args[0]))
    {
      throw new WrongDefinedRuleException(
        sprintf("%s rule takes exactly one int parameter!", self::$name)
      );
    }

    if (strlen($this->value) > $this->args[0])
    {
      $this
        ->validator
        ->addError($this->field, sprintf(self::$errorMessage, $this->args[0]));
    }

    parent::handle();
  }
}
