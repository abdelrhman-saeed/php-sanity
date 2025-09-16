<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Json extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'json';

  /**
   * @property string
   */
  protected static string $errorMessage = 'invalid json format';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! json_validate($this->value)) $this->addError();

    parent::handle();
  }
}
