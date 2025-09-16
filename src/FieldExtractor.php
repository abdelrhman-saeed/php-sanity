<?php

namespace AbdelrhmanSaeed\PHP\Sanity;


class FieldExtractor
{
  public static function extract(array $pathSegments, mixed &$data, array &$fields, string $prefix = ''): void
  {
    if (empty($pathSegments))
    {
      $fields[$prefix] = $data;
      return;
    }

    if (( $segment = array_shift($pathSegments) ) === '*' && !empty($data)) 
    {
      foreach ($data as $i => $item)
        self::extract($pathSegments, $item, $fields, ltrim("$prefix.$i", '.'));

      return;
    }

    isset($data[$segment])
      ? $data = &$data[$segment]
      : $data = null;

    self::extract($pathSegments, $data, $fields, ltrim("$prefix.$segment", '.'));
  }
}
