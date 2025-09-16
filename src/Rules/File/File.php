<?php

namespace NightCommit\PHP\Sanity\Rules\File;

use NightCommit\PHP\Sanity\Rules\Rule;


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
