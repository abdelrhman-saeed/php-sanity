<?php

namespace NightCommit\PHP\Sanity\Test\Rules\File;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\File\FSize;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;
use NightCommit\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;

class FSizeTest extends BaseRuleTestCase
{

  private array $uploadedFile;

  protected function setUp(): void
  {
    parent::setUp();
    $this->uploadedFile   = ['name' => 'image.jpg', 'size' => 51200]; // 50 KB
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
    $rule = new FSize(
      $this->validatorMock,
      $this->field,
      $this->uploadedFile,
      [$this->uploadedFile],
      [100, 0, 'KB']
    );

    $this->expectsAddErrorToBeCalled(
      [$this->field, sprintf($rule->getErrorMessage(), 'less', 100, 'KB')]
    );

    $rule->handle();
  }

  public function testHandleWithFileSizeMoreThanMaximum(): void
  {

    $this->uploadedFile['size'] = 204800;

    $rule = new FSize(
      $this->validatorMock,
      $this->field,
      $this->uploadedFile,
      [$this->uploadedFile],
      [0, 100, 'KB']
    );

    $this->expectsAddErrorToBeCalled(
      [$this->field, sprintf($rule->getErrorMessage(), 'more', 100, 'KB')]
    );

    $rule->handle();
  }
}
