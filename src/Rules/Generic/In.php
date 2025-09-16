<?php

namespace NightCommit\PHP\Sanity\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class In extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'in';

  /**
   * @property string
   */
  protected static string $errorMessage = 'value must be one of the specified values!';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]))
      throw new WrongDefinedRuleException(sprintf("the '%s' Rule take at least one paramter", self::$name));

    if (! in_array($this->value, $this->args)) $this->addError();

    parent::handle();
  }
}
