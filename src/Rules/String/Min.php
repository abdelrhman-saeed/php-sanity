<?php

namespace NightCommit\PHP\Sanity\Rules\String;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Min extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'min';

  /**
   * @property string
   */
  protected static string $errorMessage = "value length should be more than %d";

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
        sprintf("the '%s' rule takes exactly one int parameter!", self::$name)
      );
    }

    if (strlen($this->value) < $this->args[0]) $this->addError($this->args[0]);

    parent::handle();
  }
}
