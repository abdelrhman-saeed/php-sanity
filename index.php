<?php


require __DIR__ . '/vendor/autoload.php';

use AbdelrhmanSaeed\PHP\Http\{Request, Response};
use AbdelrhmanSaeed\PHP\Sanity\Dev\UserValidator;
use AbdelrhmanSaeed\PHP\Sanity\Rules\Rule;
use AbdelrhmanSaeed\PHP\Sanity\Rules\RuleFactory;

$request = new Request;

// RuleFactory::register('testRule', function (string $errorMessage = "error"): bool {

  // return false;
// });

//class TestRule extends Rule
//{
//
//  protected static string $errorMessage = "that's a new error message";
//
//  public function handle(): void
//  {
//    $this->validator->addError($this->field, self::$errorMessage);
//    parent::handle();
//  }
//}

// RuleFactory::register('testRule', fn (string $errorMessage = "that's an error message!", bool $continueValidation = true) => false);
// RuleFactory::register('testRule2', TestRule::class);

$validator = new UserValidator($request->data() + $request->files());

// Response::json($validator->getValidated());
//
Response::json([
  'data'    => $validator->validated(),
  'errors'  => $validator->errors()
]);
