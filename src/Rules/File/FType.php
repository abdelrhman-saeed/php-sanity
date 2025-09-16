<?php

namespace NightCommit\PHP\Sanity\Rules\File;

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;


class FType extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'ftype';

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

    if (! in_array($fileType, $this->args)) $this->addError(implode(',', $this->args));

    parent::handle();
  }
}
