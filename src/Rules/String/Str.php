<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Str extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'string';

  /**
   * @property string
   */
  protected static string $errorMessage = 'should be string';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! is_string($this->value)) {

      $this->addError();
      return;
    }

    parent::handle();
  }
}
