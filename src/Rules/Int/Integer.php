<?php

namespace NightCommit\PHP\Sanity\Rules\Int;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Rules\WrongDefinedRuleException;


class Integer extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'int';

  /**
   * @property string
   */
  protected static string $errorMessage = 'should be integer';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! is_numeric($this->value)) $this->addError();

    parent::handle();
  }
}
