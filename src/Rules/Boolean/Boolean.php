<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Boolean;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Boolean extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'boolean';

  /**
   * @property nul|string
   */
  protected static string $errorMessage = 'should be boolean';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    $shouldCast = isset($this->args[0]) && $this->args[0] === 'cast';

    if ($shouldCast && !in_array($this->value, ['yes', 'no'], true)) {
      $this->validator->addError($this->field, "should be 'yes' or 'no'.");
    }
    elseif (! is_bool($this->value)) {
      $this->validator->addError($this->field, self::$errorMessage);
    }

    parent::handle();
  }
}
