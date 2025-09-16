<?php

namespace NightCommit\PHP\Sanity\Rules\Date;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;

class Date extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'date';

  /**
   * @property string
   */
  protected static string $errorMessage = "invalid date format: %s";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    $dateFormat = $this->args[0] ?? 'Y-m-d';
    $date = \DateTime::createFromFormat($dateFormat, $this->value);

    if (($date && $date->format($dateFormat)) !== $this->value)
      $this->addError($dateFormat);

    parent::handle();
  }
}
