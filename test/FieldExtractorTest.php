<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test;

use PHPUnit\Framework\TestCase;
use AbdelrhmanSaeed\PHP\Sanity\FieldExtractor;


class FieldExtractorTest extends TestCase
{

  private array   $data;
  private array   $pathSegments;

  public function setUp(): void
  {
    $this->pathSegments = ['data', 'users', '*', 'name'];
    $this->data = [
      "data" => [
        "users" => [
          ["name" => "abdelrhman"], ["name" => "ahmed"]
        ]
      ]
    ];
  }

  public function testExtractWithEmptySegments(): void
  {
    $fields = [];
    FieldExtractor::extract([], $this->data, $fields);

    $this->assertEquals(['' => $this->data], $fields);
  }

  public function testExtract(): void
  {
    $fields   = [];
    $expected = [
      'data.users.0.name' => 'abdelrhman',
      'data.users.1.name' => 'ahmed'
    ];

    FieldExtractor::extract($this->pathSegments, $this->data, $fields);

    $this->assertEquals($expected, $fields);
  }

  public function testExtractWithMissingData(): void
  {
    $data     = $fields = [];
    $expected = [implode('.', $this->pathSegments) => null];

    FieldExtractor::extract($this->pathSegments, $data, $fields);

    $this->assertEquals($expected, $fields);
  }
}
