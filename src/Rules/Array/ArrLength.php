<?php

namespace NightCommit\PHP\Sanity\Rules\Array;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class ArrLength extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'array_length';

  /**
   * @property null|string
   */
  protected static string $errorMessage = "array length should be %d";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (isset($this->args[0]) && ! is_numeric($this->args[0]))
      throw new WrongDefinedRuleException('length rule takes exactly one integer parameter');

    if ((int) $this->args[0] !== count($this->value))
      $this->addError($this->args[0]);

    parent::handle();
  }

}
