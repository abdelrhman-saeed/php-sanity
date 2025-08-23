<?php

namespace AbdelrhmanSaeed\PHP\Validator\Rules;


interface IScalarGenerator
{
  /**
   *
   * @return StringRules
   */
  public function string(): StringRules;

  /**
   *
   * @return IntRules
   */
  public function int(): IntRules;

  /**
   *
   * @return FloatRules
   */
  public function float(): FloatRules;

  /**
   *
   * @return ArrayRules
   */
  public function array(): ArrayRules;

  /**
   *
   * @return BooleanRules
   */
  public function boolean(): BooleanRules;
}
