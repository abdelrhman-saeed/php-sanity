<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Rules\File;

use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Validator;

class File extends Rule
{
  /**
   * @property string
   */
  public static string $name = 'file';

  /**
   * @property string
   */
  protected static string $errorMessage = 'file upload error';

  /**
   * gives the field value to the next handler
   *
   * @return void
   */
  public function handle(): void
  {
    if (! is_uploaded_file($this->value['tmp_name'])) {

      $this->addError();
      return;
    }

    parent::handle();
  }
}
