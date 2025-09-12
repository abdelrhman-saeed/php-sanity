<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\File;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class FType extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'file_type';

  /**
   * @property string
   */
  protected static string $errorMessage = 'extension should be: %s';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (count($this->args) < 1)
    {
      throw new WrongDefinedRuleException(
        "'" . self::$name . "' rule takes at least 1 paramter"
      );
    }

    $fileType = strtolower(
      pathinfo( basename($this->value['name']), PATHINFO_EXTENSION )
    );

    if (! in_array($fileType, $this->args))
    {
      $this->validator->addError($this->field,
        sprintf(self::$errorMessage, implode(',', $this->args))
      );
    }
    parent::handle();
  }
}
