<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Numeric;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Less extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'less';

  /**
   * @property string
   */
  protected static string $errorMessage = "should be less than %d";

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
        sprintf("the %s rule takes exactly one numeric parameter!", self::$name)
      );
    }

    if ($this->value >= $this->args[0])
    {
      $this
        ->validator
        ->addError($this->field, sprintf(self::$errorMessage, $this->args[0]));
    }

    parent::handle();
  }
}
