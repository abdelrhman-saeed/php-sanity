<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\String;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class Regex extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'regex';

  /**
   * @property string
   */
  protected static string $errorMessage = 'the value does not match the specified format';

  /**
   *
   * @property <String, String>
   */
  private array $regex = [

    'alpha'     => '/\[A-z]+/',
    'num'       => '/\d+/',
    'alpha_num' => '/[A-z0-9]+/',
  ];

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! isset($this->args[0]))
    {
      throw new WrongDefinedRuleException(
        sprintf(
          "the '%s' rule takes exactly one parameter as a regex format!",
          self::$name
        ));
    }

    ! isset($this->regex[$this->args[0]])
      ?: $this->args[0] = $this->regex[$this->args[0]];

    if (! preg_match($this->args[0], $this->value)) {
      $this->validator->addError($this->field, self::$errorMessage);
    }

    parent::handle();
  }
}
