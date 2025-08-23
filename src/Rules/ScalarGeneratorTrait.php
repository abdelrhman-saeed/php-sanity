<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;

use AbdelrhmanSaeed\PHP\Validator\Validator;

/**
 * @property Validator $Validator
 * @property mixed $value
 * @property string $field
 */
trait ScalarGeneratorTrait
{
  /**
   *
   * @return StringRules
   */
  public function string(): StringRules
  {
    return new StringRules($this->validator, $this->field, $this->value);
  }

  /**
   *
   * @return IntRules
   */
  public function int(): IntRules
  {
    return new IntRules($this->validator, $this->field, $this->value);
  }

  /**
   *
   * @return FloatRules
   */
  public function float(): FloatRules
  {
    return new FloatRules($this->validator, $this->field, $this->value);
  }

  /**
   *
   * @return ArrayRules
   */
  public function array(): ArrayRules
  {
    return new ArrayRules($this->validator, $this->field, $this->value);
  }

  /**
   *
   * @return BooleanRules
   */
  public function boolean(): BooleanRules
  {
    return new BooleanRules($this->validator, $this->field, $this->value);
  }
}
