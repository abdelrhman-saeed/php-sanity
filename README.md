# PHP-HTTP

`PHP-SANITY` is a PHP package to validate data by assigning pre and post defined rules to specific request fields

---

## Installation

```bash
composer require abdelrhman-saeed/php-sanity
```

---

## Usage Example

**Extending The Validator Class**

```php
<?php

use Abdelrhman\Saeed\PHP\Sanity\Validator;


class UserValidator extends Validator
{

  /**
   * implement the Validator::rules() method to define your validation rules
   *
   * @return <string, string[]>
   */
  protected static function rules(): array
  {
    return [
      'field-name' => ['rule-1', 'rule-2'],
    ];
  }
}
```

## Defined Data Validation Rules

# String Rules

| Name            | Description                             |
|-----------------|-----------------------------------------|
| str             | check if value is a string              |
| size:length     | sets a string an exact length           |
| min:limit       | sets a minimum length limit             |
| max:limit       | sets a maximum length limit             |
| json            | check if value is json                  |
| email           | check if value is a valid email format  |
| regex:value     | check if value matches the given regex  |

# Numeric Rules

| Name            | Description                                         |
|-----------------|-----------------------------------------------------|
| int             | check if value is an integer                        |
| float:percision | check if value is a float with specificed percision |
| less:value      | sets a minimum value limit                          |
| more:value      | sets a maximum value limit                          |
| unsigned        | check if a numeric value is unsigned                |

# Boolean Rules

| Name            | Description                                         |
|-----------------|-----------------------------------------------------|
| boolean:cast    | check if value is bool, if cast is set then check if the value is 'yes' or 'no'. |

# Date Rules

| Name                    | Description                                             |
|-------------------------|---------------------------------------------------------|
| date:format             | check if value is a valid date format, if format is not set then if falls back to the default format: "Y-m-d".  |
| after:another-date      | check if a date value is after another date value       |
| before:another-date     | check if a date value is before another date value      |

# Array Rules

| Name                    | Description                   |
|-------------------------|-------------------------------|
| array                   | check if a value is an array  |
| array_unique            | check if an array is unique   |
| array_length:length     | sets an exact array length    |

# Generic Rules
| Name                     | Description                                                                                      |
| ------------------------ | -------------------------------------------------------------------------------------------------|
| required                 | Ensure the value exists. If missing, further validation will not run                             |
| nullable                 | Allow missing value without throwing an error, if value is missed the following rules won't run  |
| filled                   | Check if the value is not empty                                                                  |
| in:1,2,3                 | Ensure the value is one of the specified values                                                  |
| confirmed\:another-field | Ensure the value matches another field’s value                                                   |


## Defined File Validation Rules

# to validate uploaded files, implement the "Validator::files()" static method

```php
<?php

use Abdelrhman\Saeed\PHP\Sanity\Validator;


class UserValidator extends Validator
{

  /**
   * @return <string, string[]>
   */
  protected static function files(): array
  {
    return [
      'file-name' => ['rule-1', 'rule-2']
    ];
  }
}
```

# File Rules

| Name                          | Description                                                                                                                                                                  |
| ----------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| file                          | Check if a request field is a file                                                                                                                                           |
| file\_type\:jpg,jpeg          | Ensure file extension is one of the specified values                                                                                                                         |
| file\_size\:min,max,size-type | Validate file size (min and max) in units: `bt` (byte), `kb` (kilobyte), `mb` (megabyte), `gb` (gigabyte). If `min=0`, min size is ignored. If `max=0`, max size is ignored. |


## License

This package is licensed under the MIT License.
