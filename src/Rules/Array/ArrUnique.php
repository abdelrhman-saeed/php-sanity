<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Array;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;


class ArrUnique extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'arr_unique';

  /**
   * @property null|string
   */
  protected static string $errorMessage = 'array items should be unqiue';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    count($this->value) === count(array_unique($this->value))
      ?: $this->addError();

    parent::handle();
  }
}
