<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Float;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Floats extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'float';

  /**
   * @property string
   */
  protected static string $errorMessage = 'should be float';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! is_float($this->value)) {

      $this->addError();
      return;
    }

    parent::handle();
  }
}
