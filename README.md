extbase_filter
===================

This extbase extension allows you to use filters on Domain-Model properties. For example, if you want to trim a value before it will be validated by a Validator.

```php
/**
 * @var string
 * @validate StringLength(minimum=4, maximum)
 * 
 * @filter Trim
 **/
 private $title;
```


