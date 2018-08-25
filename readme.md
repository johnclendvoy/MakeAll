# MakeAll


[![Latest Stable Version](https://poser.pugx.org/johnclendvoy/makeall/v/stable?format=flat-square)](https://packagist.org/packages/johnclendvoy/makeall)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/johnclendvoy/makeall.svg?style=flat-square)](https://packagist.org/packages/johnclendvoy/makeall)

This package makes it easy to generate all the files needed for a new object in a laravel project. With one command, it will generate, a Model, Controller, Request, Migration and a folder of views all based on templates that you design for your workflow.

## Installation

Via Composer

``` bash
$ composer require johnclendvoy/makeall
```

## Usage

``` bash
$ php artisan make:all ObjectName
```
Where `ObjectName` is the singular name of your object. For example, `Event`, `BlogPostComment`, or `PhotoGallery` or whatever you need for your project.
This single command is the equivalent to running the following commands;

``` bash
$ php artisan make:model ObjectName
$ php artisan make:controller ObjectNameController
$ php artisan make:request ObjectNameFormRequest
$ php artisan make:migration create_object_names_table --create=object_names
$ mkdir ./resources/views/object-name
$ cd resources/views/object-name
$ touch index.blade.php
$ touch show.blade.php
$ touch create.blade.php
```

<!---
## Testing

``` bash
$ composer test
```
Tests coming soon

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.
-->

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [John C. Lendvoy](http://johnclendvoy.ca)

## License

MIT license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/johnclendvoy/makeall.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/johnclendvoy/makeall.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/johnclendvoy/makeall/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/johnclendvoy/makeall
[link-downloads]: https://packagist.org/packages/johnclendvoy/makeall
[link-travis]: https://travis-ci.org/johnclendvoy/makeall
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/johnclendvoy
[link-contributors]: ../../contributors]
