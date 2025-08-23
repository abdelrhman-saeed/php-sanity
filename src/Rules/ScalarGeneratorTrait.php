<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;


/**
 * @property mixed $currentInput
 */
trait ScalarGeneratorTrait
{
  /**
   *
   * @return StringRules
   */
  public function string(): StringRules
  {
    return new StringRules($this->currentInput);
  }

  /**
   *
   * @return IntRules
   */
  public function int(): IntRules
  {
    return new IntRules($this->currentInput);
  }

  /**
   *
   * @return FloatRules
   */
  public function float(): FloatRules
  {
    return new FloatRules($this->currentInput);
  }

  /**
   *
   * @return ArrayRules
   */
  public function array(): ArrayRules
  {
    return new ArrayRules($this->currentInput);
  }

  /**
   *
   * @return BooleanRules
   */
  public function boolean(): BooleanRules
  {
    return new BooleanRules($this->currentInput);
  }
}
