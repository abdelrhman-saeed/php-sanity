<?php

namespace NightCommit\PHP\Sanity\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Rules\WrongDefinedRuleException;


class Required extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'required';

  /**
   * @property string
   */
  protected static string $errorMessage = 'required';

  /**
  * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (is_null($this->value))
    {
      $this->addError();
      return;
    }

    parent::handle();
  }
}
