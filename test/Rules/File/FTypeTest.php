<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\File;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\File\FType;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FTypeTest extends TestCase
{

  private string  $field;
  private string  $errorMessage;
  private array   $file = [];
  private array   $ftypeArgs = [];
  private MockObject|Validator $validatorMock;

  protected function setUp(): void
  {
    $this->field          = 'file';
    $this->ftypeArgs      = ['jpeg'];
    $this->file           = ['name' => 'image.jpg'];
    $this->errorMessage   = "extension should be: " . implode($this->ftypeArgs);
    $this->validatorMock  = $this->createMock(Validator::class);
  }
  public function testHandle(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, $this->errorMessage);

    (new FType($this->validatorMock, $this->field, $this->file, [], $this->ftypeArgs))
      ->handle();

    (new FType($this->validatorMock, $this->field, [], []))
      ->handle();
  }
}
