<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules;

use AbdelrhmanSaeed\PHP\Sanity\Validator;

abstract class Rule
{
  /**
   * @property string
   */
  public static string $name = 'abstract_rule';

  /**
   * defines error message for the sub Rule::class objects
   *
   * @property string
   */
  protected static string $errorMessage = 'Check did not pass';

  /**
   * @property null|Rule stores the next handler
   */
  protected ?Rule $next = null;


  /**
   * @param Validator $validator
   * @param string    $field
   * @param mixed     $value
   * @param array     $data
   * @param array     $args
   */
  public function __construct(
    protected Validator $validator,
    protected string    $field,
    protected mixed     $value,
    protected array     $data,
    protected array     $args = []
  ) {}

  /**
   * @param Rule $next
   *
   * @return Rule
   */
  public function setNext(Rule $next): Rule
  {
    return $this->next = $next;
  }

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    $this->next?->handle();
  }

  public static function getErrorMessage(): string
  {
    return static::$errorMessage;
  }
}
