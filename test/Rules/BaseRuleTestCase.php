<?php

namespace NightCommit\PHP\Sanity\Test\Rules;

use NightCommit\PHP\Sanity\Validator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class BaseRuleTestCase extends TestCase
{

  protected MockObject|Validator $validatorMock;
  protected array $data = [];
  protected array $args = [];
  protected string $field = 'field';
  protected mixed $value = null;


  protected function setUp(): void
  {
    $this->validatorMock = $this->createMock(Validator::class);
  }

  protected function expectsAddErrorToBeCalled(array $with, int $exactly = 1): void
  {
    $this
      ->validatorMock
      ->expects($this->exactly($exactly))
      ->method('addError')
      ->with(...$with);
  }
}
