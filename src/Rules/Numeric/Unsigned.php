<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Numeric;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Unsigned extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'unsigned';

  /**
   * @property string
   */
  protected static string $errorMessage = 'should be unsigned';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if ($this->value < 0) $this->validator->addError($this->field, self::$errorMessage);

    parent::handle();
  }
}
