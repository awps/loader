### Loader

A simple loader that is designed to work with both classes and normal PHP files.

### Installation
#### With composer:

```php
composer require awps/loader
```

#### Manually:
```php
require_once 'getloader.php';
```

### Usage

#### Load PHP classes:
```php
Awps\Loader::loadClasses( $path, $namespace );
```

This will autoload all PHP classes from `$path` and will assume that the namespace in those classes is `$namespace`;

#### Load simple PHP files:
```php
Awps\Loader::loadFiles( $path, $pattern );
```

This will autoload all php files from `$path` that contains `$pattern` in their name.

### Examples
```php
// Autoload classes from `inc` folder and set the namespace to `Awesome`
Awps\Loader::loadClasses( __DIR__ . 'inc', 'Awesome' );

// Now you can initialize a class. For example: 
new Awesome\Something();

// -------------------------------------------------------

// Include all php files from `functions`
Awps\Loader::loadFiles( __DIR__ . 'functions', 'component-' );

// This one will include all php files that contains `component-` string in their name
// from `functions` directory.
// Now you may call a function defined in one of those files. For example: 
do_something_special();

```
