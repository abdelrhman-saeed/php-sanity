<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Rules\WrongDefinedRuleException;
use stdClass;

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
