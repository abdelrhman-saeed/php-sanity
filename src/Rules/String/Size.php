<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Size extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'size';

  /**
   * @property string
   */
  protected static string $errorMessage = "the field length should be %d";

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
        sprintf(
          "the '%s' rule takes exactly one integer parameter!",
          self::$name
        ));
    }

    if (strlen($this->value) != $this->args[0]) $this->addError($this->args[0]);

    parent::handle();
  }
}
