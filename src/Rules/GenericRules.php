<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;


class GenericRules extends Rule implements IScalarGenerator
{
  use ScalarGeneratorTrait;


  public function required(): self
  {
    ! is_null($this->value)
      ?: $this->addError('required');

    return $this;
  }

  public function filled(): self
  {
    !empty($this->value)
      ?: $this->addError('must not be empty');

    return $this;
  }

  public function nullable(): self
  {
    ! (empty($this->value) && !is_null($this->value))
      ?: $this->addError('at least should be null');

    return $this;
  }

  public function callback(\Closure $closure, string $error)
  {
    $closure($this->value)
      ?: $this->addError($error);
  }
}
