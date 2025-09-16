<?php

namespace NightCommit\PHP\Sanity\Rules\Float;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Percision extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'percision';

  /**
   * @property string
   */
  protected static string $errorMessage = "numbers count after dot should be: %d";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]) || ! is_numeric($this->args[0]))
      throw new WrongDefinedRuleException('the float percision paramter should be an integer!');

    if (! preg_match('/^\d+(\.\d{1,' . $this->args[0] . '})?$/', (string) $this->value))
      $this->addError($this->args[0]);

    parent::handle();
  }
}
