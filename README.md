# String

This is a port of Laravel 3's String class to Illuminate.

To install add the following to your `composer.json` file :

```json
"anahkiasen/string": "dev-master"
```

Then register Str's service provider with Laravel in your `app/config/app.php` file, in the array `providers` add (you have now died of) this entry :

```php
'Anahkiasen\StrServiceProvider',
```

And in the very same file, in the `aliases` array add the following :

```php
'Str' => 'Anahkiasen\StrFacade',
```

And there you go.