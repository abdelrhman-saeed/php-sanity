<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Test\Rules\File;

use AbdelrhmanSaeed\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use AbdelrhmanSaeed\PHP\Sanity\Rules\File\FSize;
use AbdelrhmanSaeed\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FSizeTest extends TestCase
{

  private MockObject|Validator $validatorMock;
  private array $uploadedFile;
  private string $field = 'file';

  protected function setUp(): void
  {
    $this->validatorMock  = $this->createMock(Validator::class);
    $this->uploadedFile   = ['name' => 'image.jpg', 'size' => 51200]; // 50 KB
    $this->field = 'file';
  }

  public function testHandleWithNoArgs(): void
  {
    $this->expectException(WrongDefinedRuleException::class);
    $this->expectExceptionMessage(sprintf("'%s' rule takes exactly 3 paramters", FSize::$name));

    (new FSize($this->validatorMock, $this->field, $this->uploadedFile, [$this->uploadedFile]))
      ->handle();
  }

  public function testHandleWithNonSupportedFileSize(): void
  {
    $this->expectException(WrongDefinedRuleException::class);
    $this->expectExceptionMessage(
      "the supported file sizes are: ". implode(',', ['BT', 'KB', 'MB', 'GB'])
    );

    (new FSize(
      $this->validatorMock,
      $this->field,
      $this->uploadedFile,
      [$this->uploadedFile],
      ['0', 10000, 'NotSupportedFileSize'])
    )->handle();
  }

  public function testHandleWithFileSizeLessThanMinimum(): void
  {
    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, "size should not be less than 100 KB");

    (new FSize(
      $this->validatorMock,
      $this->field,
      $this->uploadedFile,
      [$this->uploadedFile],
      [100, 0, 'KB'])
    )->handle();
  }

  public function testHandleWithFileSizeMoreThanMaximum(): void
  {

    $this->uploadedFile['size'] = 204800;

    $this
      ->validatorMock
      ->expects($this->once())
      ->method('addError')
      ->with($this->field, "size should not be more than 100 KB");

    (new FSize(
      $this->validatorMock,
      $this->field,
      $this->uploadedFile,
      [$this->uploadedFile],
      [0, 100, 'KB'])
    )->handle();
  }
}
