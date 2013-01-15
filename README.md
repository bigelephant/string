# String

This is a string helper class for things like turning strings into URL friendly slugs.

To install add the following to your `composer.json` file :

```json
"bigelephant/string": "dev-master"
```

## To use it within Laravel do the following

Edit your `app/config/app.php` file and add the following to the `providers` array:
```php
'BigElephant\String\StringServiceProvider',
```

And then so you can use it from the `String` alias (or `Str`, if you choose so then replace `String` with `Str` in the following) add the following line to the `aliases` array:

```php
'String' => 'BigElephant\String\StringFacade'
```

[![Build Status](https://secure.travis-ci.org/bigelephant/string.png)](http://travis-ci.org/bigelephant/string)