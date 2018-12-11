# Harvest API

**Important: This package is under development and thus neither fully implemented or tested. Not production ready!**

Harvest 2 API using OAuth access tokens

Please see <https://github.com/arueckauer/harvest-api> for background information.

## Getting Started

Install via [composer](https://getcomposer.org/)

```composer require arueckauer/harvest-api```

## Usage

### Initialization

#### Zend Expressive

Place configuration of your Harvest account in`config/autoload/application.local.php`(replace example data with credentials of your account):

```php
<?php

declare(strict_types = 1);

return [
    arueckauer\HarvestApi\ClientFactory::class => [
        'config' => [
            'headers' => [
                'Authorization'      => 'Bearer ???',
                'Harvest-Account-Id' => '???',
                'User-Agent'         => 'My Harvest App (https://example.com)',
            ],
        ],
    ],
];

```

Create a handler via CLI (replace example class name with your handler name):

```bash
composer expressive handler:create "App\Handler\HarvestApi"
```

This will create a Handler class and factory for it as well as register these in `config/autoload/zend-expressive-tooling-factories.global.php` for you.

Add a constructor injection to the created Handler class. Then in the newly created factory get the Harvest client object from the container and pass it to the Handler class constructor - `src/App/src/Handler/HarvestApiFactory.php`:

```php
<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class HarvestApiFactory
{
    public function __invoke(ContainerInterface $container) : HarvestApi
    {
        return new HarvestApi($container->get(\arueckauer\HarvestApi\Client::class));
    }
}

```



#### Other context

```php
<?php

// public/index.php
    
require_once __DIR__ . '/../vendor/autoload.php';

$headers = [
    'Authorization'      => 'Bearer 1691208.pt.BzCN8w2Nhs8TMeRfsX_2S2_HDup7e_7e5GPXUUsgkAOu_30BFI9zJjJLLZvyA2x3p3kX_OWBoJOI7394BvW0Bw',
    'Harvest-Account-Id' => '977320',
    'User-Agent'         => 'Furry Invention Inc. (https://furry-invention.com/contact)',
];
$client = new \arueckauer\HarvestApi\Client($headers);

```



## Test

Work in progress

## License

MIT License. See [LICENSE](LICENSE)

## Contributing

Please read and adhere to our [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md).

### Submitting Bugs

This package is still under development and thus incomplete features and bugs are to be expected. If you experience any difficulties, feel free to open an issue here on GitHub.

### Pull requests

Contributions via pull requests are welcome.

## Acknowledgements

This package is heavily inspired by [bestit/harvest-api](https://github.com/bestit/harvest-api), which at the time of development supported Harvest API V1.

## Todo

To check the current status of the implementation, check out [CHECKLIST](CHECKLIST.md) and [open issues](https://github.com/arueckauer/harvest-api/issues).
