<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\File;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class FSize extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'file_size';

  /**
  *
  * @property null|string
  */
  protected static string $errorMessage = "size should not be %s than %d %s";

  /**
  *
  * @property <string, Integer>
  */
  private array $sizes = [

    'BT' => 1,
    'KB' => 1024,
    'MB' => 1024 * 1024,
    'GB' => 1024 * 1024 * 1024,
  ];

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (count($this->args) !== 3)
    {
      throw new WrongDefinedRuleException(
        sprintf("'%s' rule takes exactly 3 paramters", self::$name)
      );
    }

    $this->args[2] = strtoupper($this->args[2]);

    if (! array_key_exists($this->args[2], $this->sizes))
    {
      throw new WrongDefinedRuleException(
        "the supported file sizes are: ". implode( ',', array_keys($this->sizes) ));
    }

    $fileSize = $this->value['size'] / $this->sizes[$this->args[2]];

    if ($fileSize < (int) $this->args[0])
      $this->addError('less', $this->args[0], $this->args[2]);

    if ((int) $this->args[1] !== 0 && $fileSize > (int) $this->args[1])
      $this->addError('more', $this->args[1], $this->args[2]);

    parent::handle();
  }
}
