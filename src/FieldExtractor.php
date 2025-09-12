<?php

namespace AbdelrhmanSaeed\PHP\Sanity;


class FieldExtractor
{
  public static function extract(array $pathSegments, mixed &$data, array &$fields, string $prefix = ''): void
  {
    if (empty($pathSegments)) {
      $fields[$prefix] = $data;
      return;
    }

    if (! is_array($data)) return;

    $segment = array_shift($pathSegments);
    $newPrefix = ltrim("$prefix.$segment", '.');

    if (array_key_exists($segment, $data)) {
      self::extract($pathSegments, $data[$segment], $fields, $newPrefix);
      return;
    }

    if (empty($data)) self::extract($pathSegments, $data, $fields, $newPrefix);

    foreach ($data as $i => $item)
    {
      $newPrefix  = ltrim("$prefix.$i", '.');

      if ($segment !== '*') {
        $item       = null;
        $newPrefix  = ltrim("$prefix.$segment", '.');
      }

      self::extract($pathSegments, $item, $fields, $newPrefix);

    }
  }
}
