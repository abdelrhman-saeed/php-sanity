<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\Date;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;

class Date extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'date_';

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

    $date && $date->format($dateFormat) === $this->value ?:
      $this->validator->addError($this->field, sprintf(self::$errorMessage, $dateFormat));

    parent::handle();
  }
}
