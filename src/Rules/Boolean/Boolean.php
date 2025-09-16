<?php

namespace NightCommit\PHP\Sanity\Rules\Boolean;

use NightCommit\PHP\Sanity\Rules\Rule;


class Boolean extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'boolean';

  /**
   * @property nul|string
   */
  protected static string $errorMessage = "should be boolean, if it's casted then: 'yes' or 'no'";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    $shouldCast = isset($this->args[0]) && $this->args[0] === 'cast';

    if ($shouldCast && !in_array($this->value, ['yes', 'no'], true)
        || ! $shouldCast && !is_bool($this->value))
    {
      $this->addError();
    }

    parent::handle();
  }
}
