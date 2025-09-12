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
      $this->validator->addError($this->field, self::$errorMessage);
    }

    if (! isset($this->args[0])) {
      parent::handle();
      return;
    }

    if (! is_numeric($this->args[0]))
      throw new WrongDefinedRuleException('the float percision paramter should be an integer!');

    if (! preg_match('/^\d+(\.\d{1,' . $this->args[0] . '})?$/', (string) $this->value)) {
      $this->validator->addError($this->field, "the float percision should be {$this->args[0]}");
    }

    parent::handle();
  }
}
