<?php

namespace NightCommit\PHP\Sanity\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Rules\WrongDefinedRuleException;


class Filled extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'filled';

  /**
   * @property string
   */
  protected static string $errorMessage = 'should not be empty';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (empty($this->value)) {

      $this->addError();
      return;
    }

    parent::handle();
  }
}
