<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;


class Arr extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'array';

  /**
   * @property null|string
   */
  protected static string $errorMessage = 'should be an array';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! is_array($this->value)) $this->addError();

    parent::handle();
  }
}
