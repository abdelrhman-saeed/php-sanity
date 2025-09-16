<?php

namespace NightCommit\PHP\Sanity\Test\Rules\File;

use NightCommit\PHP\Sanity\Exceptions\WrongDefinedRuleException;
use NightCommit\PHP\Sanity\Rules\File\FType;
use NightCommit\PHP\Sanity\Test\Rules\BaseRuleTestCase;


class FTypeTest extends BaseRuleTestCase
{
  public function testHandleIfRuleParamterIsNotDefined(): void
  {
    $this->expectException(WrongDefinedRuleException::class);

    (new FType($this->validatorMock, $this->field, [], []))
      ->handle();
  }

  public function testHandleIfFileExtensionIsNotOneOfTheDefinedExtensions(): void
  {
    $rule = new FType(
      $this->validatorMock,
      $this->field,
      $this->value = ['name' => 'image.jpg'],
      $this->data,
      $this->args = ['jpeg']
    );

    $this->expectsAddErrorToBeCalled([
      $this->field, sprintf($rule->getErrorMessage(), implode($this->args))
    ]);

    $rule->handle();
  }
}
