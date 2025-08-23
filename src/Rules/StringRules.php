<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;


class StringRules extends Rule
{


  public function min(int $len): self
  {
    if (strlen($this->value) < $len)
      $this->addError("length should not be less that $len");

    return $this;
  }

  public function max(int $len): self
  {
    if (strlen($this->value) > $len)
      $this->addError("length should not be more that $len");

    return $this;
  }

  public function size(int $len): self
  {
    strlen($this->value) === $len
      ?: $this->addError("length should equal to $len");

    return $this;
  }

  public function email(): self
  {
    filter_var($this->value, FILTER_VALIDATE_EMAIL)
      ?: $this->addError('invalid email form');

    return $this;
  }
}
