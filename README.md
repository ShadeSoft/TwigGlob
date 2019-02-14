# TwigGlob

> Twig extension for usage of PHP's glob function.

## Installation

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require shadesoft/twig-glob
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Including into Symfony 3-4 container (if autowire and autoconfigure is set to true)

```yaml
# app/config/services.yml for Symfony 3 or config/services.yaml for Symfony 4

ShadeSoft\Twig\GlobExtension: ~
```

### Including into Symfony 2 container

```yaml
# app/config/services.yml

shadesoft.twig.glob_extension:
    class: ShadeSoft\Twig\GlobExtension
    tags:
        - { name: twig.extension }
```

### Including into Slim Framework's Twig view renderer

```php
// src/dependencies.php

// ...
$container['view'] = function($c) {
    //...
    $view->addExtension(new ShadeSoft\Twig\GlobExtension);
    //...
}
```

## Usage

Add \ShadeSoft\Twig\GlobExtension to your Twig environment's dependencies (or include into one of the frameworks above), then you can use the filter:

```twig
{# Without parameters, the filter will return both the matched strings and the found resource as associative array, so you can use it like below: #}
{% for size, icon in 'img/icons/favicon-*.png'|glob %}
    <link rel="icon" type="image/png" sizes="{{ size }}" href="{{ asset(icon) }}">
{% endfor %}

{# With the optional returnMatch parameter set to false, you will get a simple array with the found resources, like below: #}
{% for css in 'node_modules/@fortawesome/fontawesome-free-webfonts/css/*.css'|glob(false) %}
    <link href="{{ asset(css) }}" rel="stylesheet">
{% endfor %}
```
