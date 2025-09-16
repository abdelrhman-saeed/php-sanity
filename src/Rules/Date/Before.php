<?php

namespace NightCommit\PHP\Sanity\Rules\Date;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;

use DateTime;


class Before extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'before';

  /**
   * @property null|string
   */
  protected static string $errorMessage = "date should be before: %s";

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]))
      throw new WrongDefinedRuleException("the comparison date is not specified!");

    $date = (new DateTime($this->value));
    $dateToCompareWith = (new DateTime($this->data[$this->args[0]]));

    if ($date >= $dateToCompareWith) $this->addError($this->args[0]);

    parent::handle();
  }

}
