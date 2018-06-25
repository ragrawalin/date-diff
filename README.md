Date Difference Calculator Application
========================

The "Date Difference Calculator Application" calculates difference between 2 given dates.

Requirements
------------

  * PHP 7.1.3 or higher;
  * and the [usual Symfony application requirements][1].

Installation
------------

Execute this command to install the project:

```bash
$ composer install
$ npm install
```

Usage
-----

There's no need to configure anything to run the application. Just execute this
command to run the built-in web server and access the application in your
browser using the URL, returned on executing the command:

```bash
$ cd date-diff/
$ php bin/console server:run
```

Alternatively, you can [configure a fully-featured web server][2] like Nginx
or Apache to run the application.

Tests
-----

Execute this command to run tests:

```bash
$ cd date-diff/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
