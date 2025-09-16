<?php

namespace NightCommit\PHP\Sanity;


class ValidatedDataBuilder
{
  public static function build(string $field, mixed $value, array &$validatedData, array &$errors): void
  {
    if ( !empty($errors[$field]) || is_null($value) ) return;

    $fieldKeys  = explode('.', $field);
    $currentKey = &$validatedData;

    foreach ($fieldKeys as $key) $currentKey = &$currentKey[$key];

    $currentKey = $value;
  }
}
