<?php

namespace NightCommit\PHP\Sanity\Rules\String;

use NightCommit\PHP\Sanity\Rules\Rule;


class Email extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'email';

  /**
   * @property string
   */
  protected static string $errorMessage = 'invalid email format';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! filter_var($this->value, FILTER_VALIDATE_EMAIL)) $this->addError();

    parent::handle();
  }
}
