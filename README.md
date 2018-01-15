extbase_filter
===================

This extbase extension allows you to use filters on Domain-Model properties. For example, if you want to trim a value before it will be validated by a Validator.

## Build information
[![Build Status](https://travis-ci.org/AOEpeople/extbase_filter.svg?branch=master)](https://travis-ci.org/AOEpeople/extbase_filter)

```php
/**
 * @var string
 * @validate StringLength(minimum=4, maximum=6)
 * 
 * @filter Trim
 */
 private $title;
```


