# PHP-SANITY

A powerful and flexible PHP validation package that allows you to validate data by defining pre and post validation rules for specific request fields.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue.svg)](https://php.net/)

## Features

- **Extensible**: Easy to extend with custom validation rules
- **Comprehensive**: Built-in rules for strings, numbers, booleans, dates, arrays, and files
- **Flexible**: Support for both class-based and closure-based custom rules
- **File Validation**: Dedicated file upload validation with size and type checking
-  **Type Safe**: Strong type checking and validation
- **Field Dependencies**: Cross-field validation support
-  **Nested Validation**: Support for dot notation (`user.name`) and wildcard patterns (`authors.*.email`)
- **Array Validation**: Validate complex nested arrays and objects

## Installation

Install via Composer:

```bash
composer require abdelrhman-saeed/php-sanity
```

## Quick Start

### Basic Usage

Create a validator by extending the base `Validator` class:

```php
<?php

use NightCommit\PHP\Sanity\Validator;

class UserValidator extends Validator
{
    /**
     * Define validation rules for your fields
     *
     * @return array<string, string[]>
     */
    protected static function rules(): array
    {
        return [
            'name'      => ['required', 'str', 'min:2', 'max:50'],
            'email'     => ['required', 'email'],
            'age'       => ['required', 'int', 'more:0', 'less:120'],
            'password'  => ['required', 'str', 'min:8'],
            'password_confirmation' => ['required', 'confirmed:password'],

            'personal'         => ['required', 'array'],
            'personal.address' => ['required', 'str', 'max: 100'],

            'posts'             => ['nullable', 'array'],
            'posts.*.title'     => ['required', 'str', 'min:3'],
            'posts.*.content'   => ['required', 'str', 'min:3', 'max:200'],
        ];
    }
}
```

### Validating Data

```php
// Sample data to validate
$data = [
    'name'      => 'John Doe',
    'email'     => 'john@example.com',
    'age'       => 25,
    'password'  => 'securepass123',
    'password_confirmation' => 'securepass123',

    'personal' => ['address' => 'some place'],

    'posts' => [
        ['title' => 'title-1', 'content' => 'lorem ipsum'],
        ['title' => 'title-1', 'content' => 'lorem ipsum'],
    ]
];

// Perform validation
$validator = new UserValidator($data);

if (! empty($validator->getErrors())) {
    // Handle validation errors
}

// get only validated data
$validator->validated();

// get all data
$validator->all();
```

## Validation Rules

### String Rules

| Rule | Description | Example |
|------|-------------|---------|
| `str` | Validates that the value is a string | `'name' => ['str']` |
| `size:length` | Validates exact string length | `'code' => ['str', 'size:6']` |
| `min:limit` | Sets minimum string length | `'name' => ['str', 'min:2']` |
| `max:limit` | Sets maximum string length | `'name' => ['str', 'max:50']` |
| `json` | Validates JSON format | `'config' => ['json']` |
| `email` | Validates email format | `'email' => ['email']` |
| `regex:pattern` | Validates against regex pattern | `'phone' => ['regex:/^\d{10}$/']` |

### Numeric Rules

| Rule | Description | Example |
|------|-------------|---------|
| `int` | Validates integer values | `'age' => ['int']` |
| `float:precision` | Validates float with specified precision | `'price' => ['float:2']` |
| `less:value` | Sets maximum numeric value | `'age' => ['int', 'less:100']` |
| `more:value` | Sets minimum numeric value | `'age' => ['int', 'more:0']` |
| `unsigned` | Validates positive numbers | `'count' => ['int', 'unsigned']` |

### Boolean Rules

| Rule | Description | Example |
|------|-------------|---------|
| `boolean` | Validates boolean values | `'active' => ['boolean']` |
| `boolean:cast` | Validates boolean or 'yes'/'no' strings | `'consent' => ['boolean:cast']` |

### Date Rules

| Rule | Description | Example |
|------|-------------|---------|
| `date:format` | Validates date format (default: Y-m-d) | `'birthdate' => ['date']` or `'created_at' => ['date:Y-m-d H:i:s']` |
| `after:date` | Validates date is after specified date | `'end_date' => ['date', 'after:start_date']` |
| `before:date` | Validates date is before specified date | `'start_date' => ['date', 'before:end_date']` |

### Array Rules

| Rule | Description | Example |
|------|-------------|---------|
| `array` | Validates that value is an array | `'tags' => ['array']` |
| `array_unique` | Validates array contains unique values | `'categories' => ['array', 'array_unique']` |
| `array_length:length` | Validates exact array length | `'choices' => ['array', 'array_length:3']` |

### Generic Rules

| Rule | Description | Example |
|------|-------------|---------|
| `required` | Field must be present and not empty | `'name' => ['required']` |
| `nullable` | Field can be missing or null | `'middle_name' => ['nullable', 'str']` |
| `filled` | Field must not be empty if present | `'bio' => ['filled']` |
| `in:value1,value2` | Value must be in specified list | `'status' => ['in:active,inactive,pending']` |
| `confirmed:field` | Value must match another field | `'password_confirmation' => ['confirmed:password']` |

## File Validation

For file upload validation, implement the `files()` method in your validator:

```php
<?php

use NightCommit\PHP\Sanity\Validator;

class FileUploadValidator extends Validator
{
    /**
     * Define file validation rules
     *
     * @return array<string, string[]>
     */
    protected static function files(): array
    {
        return [
            'avatar'    => ['file', 'ftype:jpg,jpeg,png', 'fsize:0,2,mb'],
            'document'  => ['file', 'ftype:pdf,docx', 'fsize:0,10,mb']
        ];
    }
}
```

### File Rules

| Rule | Description | Example |
|------|-------------|---------|
| `file` | Validates that field is a file | `'avatar' => ['file']` |
| `ftype:ext1,ext2` | Validates file extension | `'image' => ['file', 'ftype:jpg,png,gif']` |
| `fsize:min,max,unit` | Validates file size | `'document' => ['file', 'fsize:0,5,mb']` |

**File Size Units:**
- `bt` - bytes
- `kb` - kilobytes
- `mb` - megabytes  
- `gb` - gigabytes

**Note:** Use `0` for min or max to ignore that limit.

## Custom Validation Rules

### Method 1: Rule Class Implementation

Create a custom rule by extending the `Rule` class:

```php
<?php

use NightCommit\PHP\Sanity\Rules\Rule;
use NightCommit\PHP\Sanity\Rules\RuleFactory;

class UniqueUsernameRule extends Rule
{
    /**
     * Available properties:
     * @property \NightCommit\PHP\Sanity\Validator $validator
     * @property string $field - The field being validated
     * @property mixed $value - The field value
     * @property array $data - All request data
     * @property array $args - Rule parameters
     */
    public function handle(): void
    {
        // Your validation logic here
        $username = $this->value;
        
        // Example: Check if username exists in database
        if ($this->usernameExists($username)) {
            $this->validator->addError($this->field, "Username '{$username}' is already taken");
            return; // Stop further validation for this field
        }
        
        // Continue with other rules
        parent::handle();
    }
    
    private function usernameExists(string $username): bool
    {
        // Your database check logic here
        return false;
    }
}

// Register the custom rule
RuleFactory::register('unique_username', UniqueUsernameRule::class);
```

### Method 2: Closure Function

Register a simple validation rule using a closure:

```php
<?php

use NightCommit\PHP\Sanity\Rules\RuleFactory;

RuleFactory::register('strong_password', 
    function (string $errorMessage = "Password is not strong enough", bool $continueValidation = true, mixed $value): bool {
        // Must contain at least one uppercase, lowercase, number, and special character
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/';
        return preg_match($pattern, $value);
    }
);
```

### Using Custom Rules

```php
class UserValidator extends Validator
{
    protected static function rules(): array
    {
        return [
            'username' => ['required', 'str', 'unique_username'],
            'password' => ['required', 'str', 'min:8', 'strong_password']
        ];
    }
}
```

## Change Rules Error Messages

Define your own error messages in the sub validator $message static property

```php
<?php

use NightCommit\PHP\Sanity\Validator;

class UserValidator extends Validator
{
    /**
     * Custom error messages
     *
     * @var array<string, string>
     */
    public static array $messages = [
        'required' => 'This field is mandatory, please fill it out',
        'email'    => 'Please provide a valid email address',
        'min'      => 'This field is too short',
        'max'      => 'This field is too long',
        'int'      => 'Please enter a valid number',
        'str'      => 'This field must be text only'
    ];
    
    protected static function rules(): array
    {
        return [
            'name'  => ['required', 'str', 'min:2'],
            'email' => ['required', 'email'],
            'age'   => ['required', 'int']
        ];
    }
}
```

## Error Handling

```php
$validator = new UserValidator($data);

if (! empty( $errors = $validator->getErrors() )) {
    
    // $errors structure:
    // [
    //     'field_name' => ['Error message 1', 'Error message 2'],
    //     'another_field' => ['Error message']
    // ]
    
    foreach ($errors as $field => $fieldErrors) {
        echo "Field '{$field}' has errors:\n";
        foreach ($fieldErrors as $error) {
            echo "  - {$error}\n";
        }
    }
}
```

## Advanced Examples

### Complex User Registration Validator

```php
<?php

use NightCommit\PHP\Sanity\Validator;

class UserRegistrationValidator extends Validator
{
    protected static function rules(): array
    {
        return [
            'first_name'            => ['required', 'str', 'min:2', 'max:30'],
            'last_name'             => ['required', 'str', 'min:2', 'max:30'],
            'email'                 => ['required', 'email', 'max:255'],

            'password'              => ['required', 'str', 'min:8', 'strong_password'],
            'password_confirmation' => ['required', 'confirmed:password'],

            'age'                   => ['required', 'int', 'more:12', 'less:120'],
            'phone'                 => ['nullable', 'str', 'regex:/^\+?[\d\s-()]+$/'],

            'terms_accepted'        => ['required', 'boolean:cast'],

            'interests'             => ['nullable', 'array', 'array_unique'],
            'birth_date'            => ['required', 'date', 'before:today']
        ];
    }
    
    protected static function files(): array
    {
        return [
            'profile_picture' => ['nullable', 'file', 'ftype:jpg,jpeg,png', 'fsize:0,2,mb']
        ];
    }
}
```

## Requirements

- PHP 7.4 or higher
- Composer for installation

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you encounter any issues or have questions, please [open an issue](https://github.com/abdelrhman-saeed/php-sanity/issues) on GitHub.
