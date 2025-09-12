<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


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
