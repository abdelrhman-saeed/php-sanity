<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test;

use PHPUnit\Framework\TestCase;
use AbdelrhmanSaeed\PHP\Sanity\ValidatedDataBuilder;


class ValidatedDataBuilderTest extends TestCase
{

  public function testBuild(): void
  {
    $validatedData  = $errors = [];
    $expected       = ['data' =>
      ['users' => [['name' => $value = 'abdelrhman']]]
    ];

    ValidatedDataBuilder::build('data.users.0.name', $value, $validatedData, $errors);

    $this->assertEquals($expected, $validatedData);
  }

  public function testBuildWithErrors(): void
  {
    $validatedData = $expected = [];
    $errors = [
      $field = 'data.users.0.name' => 'error', 'error'
    ];

    ValidatedDataBuilder::build($field, 'abdelrhman', $validatedData, $errors);

    $this->assertEquals($expected, $validatedData);
  }
}
