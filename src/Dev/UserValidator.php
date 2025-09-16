<?php

namespace AbdelrhmanSaeed\PHP\Sanity\Dev;

use AbdelrhmanSaeed\PHP\Sanity\Validator;


class UserValidator extends Validator
{
  public static array $messages = [
    'required'  => 'u should fill that',
    'confirmed' => 'google'
  ];

  protected function rules(): array
  {
    return
      [
        'name'              => ['nullable', 'string', 'min:4', 'max:20', 'size:10'],
        'age'               => ['required', 'int', 'more:20', 'less:30', 'unsigned'],
        'email'             => ['required', "filled", 'string', 'email'],
        "salary"            => ["required", "float:2"],
        "married"           => ["required", "boolean"],
        "data"              => ["required", 'array', 'array_length:4', 'array_unique'],
        "password"          => ["required", "confirmed:password_confirm"],
        "enum"              => ["required", "in:one,two"],
        'wedding_date'      => ['required', 'date', 'before:after_that'],
        'after_that'        => ['required', 'after:wedding_date'],
        'personal'          => ['required', 'array'],
        'personal.address'  => ['required', 'string', 'max:200'],
        'posts'             => ['required', 'array'],
        'posts.*.id'        => ['required', 'int', 'more:0'],
        'posts.*.name'      => ['required', 'string', 'min:3'],
        
      ];
  }

  protected function files(): array
  {
    return [
        // 'picture' => ['required', 'file', 'ftype:jpg', 'fsize:100,0,kb']
    ];
  }
}
