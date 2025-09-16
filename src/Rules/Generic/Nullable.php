<?php

namespace NightCommit\PHP\Sanity\Rules\Generic;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Nullable extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'nullable';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (is_null($this->value)) return;

    parent::handle();
  }
}
