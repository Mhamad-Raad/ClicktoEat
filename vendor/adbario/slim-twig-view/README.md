# Slim Framework Twig View add-on

This is an extension for [Slim Framework Twig View](https://github.com/slimphp/Twig-View) with the following extra functions:
- adds file extension to template names automatically
- uses dot notation for template file paths

## Installation

```
composer require adbario/slim-twig-view
```

## Usage

Default extension for the template files is 'twig', this can be changed with the optional setting while registering Twig view on Slim container.

```php
// Create Slim app
$app = new \Slim\App();

// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Adbar\Slim\Views\Twig('path/to/templates', [
        'cache' => 'path/to/cache',
        // Optional template file extension, defaults to 'twig'
        'file_extension' => 'html'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    // Render template file from path 'path/to/templates/user/profile.html'
    return $this->view->render($response, 'user.profile', [
        'name' => $args['name']
    ]);
})->setName('profile');

// Run app
$app->run();
```

## Custom template functions

Read more from [Slim Framework Twig View](https://github.com/slimphp/Twig-View/blob/master/README.md#custom-template-functions)

## License

[MIT license](LICENSE.md)
