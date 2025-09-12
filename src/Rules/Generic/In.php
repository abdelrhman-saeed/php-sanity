<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Generic;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class In extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'in';

  /**
   * @property string
   */
  protected static string $errorMessage = 'value must be one of the specified values!';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]))
      throw new WrongDefinedRuleException("the'" . self::$name . "'Rule take at least one paramter");

    in_array($this->value, $this->args)
      ?: $this->validator->addError($this->field, self::$errorMessage);

    parent::handle();
  }
}
