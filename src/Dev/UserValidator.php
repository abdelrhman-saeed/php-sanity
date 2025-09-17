<?php

namespace NightCommit\PHP\Sanity\Dev;

use NightCommit\PHP\Sanity\Validator;


class UserValidator extends Validator
{
  //public static array $messages = [
  //  'required'  => 'u should fill that',
  //  'confirmed' => 'google'
  //];

  protected function rules(): array
  {
    return
      [
        'name'              => ['nullable', 'string', 'min:4', 'max:20', 'size:10'],
        'age'               => ['required', 'int', 'more:20', 'less:30', 'unsigned'],
        'email'             => ['required', "filled", 'string', 'email'],
        'posts'             => ['required', 'array'],
        'posts.*.id'        => ['required', 'int', 'more:0'],
        'posts.*.name'      => ['required', 'string', 'min:3'],
        'personal.address'  => ['required', 'string', 'max:200'],
        
      ];
  }

  protected function files(): array
  {
    return [
        // 'picture' => ['required', 'file', 'ftype:jpg', 'fsize:100,0,kb']
    ];
  }
}
