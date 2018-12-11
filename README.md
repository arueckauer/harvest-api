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
    arueckauer\Harvest\ClientFactory::class => [
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
        return new HarvestApi($container->get(\arueckauer\Harvest\Client::class));
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

Work in progress

### Pull requests

Work in progress

## Acknowledgements

This package is heavily inspired by [bestit/harvest-api](https://github.com/bestit/harvest-api), which at the time of development supported Harvest API V1.

## Todo

To check the current status of the implementation, check out [CHECKLIST](CHECKLIST.md). The following contains a list of further to-dos.

* [ ] Using DateTime objects for all DateTime and Date fields (such as `created_at` and `updated_at`)
* [ ] Set a default connect timeout (Guzzle sets it to `0` - unlimited)?
* [ ] Singular vs plural entity naming convention. Keep it in beautiful singularity or speaking with API?
* [ ] Use only one of the time entry creation methods (via duration or via start and end time) depending on `company.wants_timestamp_timers`. Is that even possible or does the user need to make the decision?
* [ ] Error Handling: What is a good approach to handle the various [API Responses](https://help.getharvest.com/api-v2/introduction/overview/general/#api-responses)?

```php
switch ($response->getStatusCode()) {
    // 200 Your request was successful.
    case 200:
        // All is well
        break;
    // 201 A new object has been created. It’s representation will be returned in the response body.
    case 201:
        // All is well
        break;
    // 403 The object you requested was found but you don’t have authorization to perform your request.
    case 403:
        // MC Hammer says, you can't touch this
        break;
    // 404 The object you requested can’t be found.
    case 404:
        // Nothing to see here, move on
        break;
    // 422 There were errors processing your request. Check the response body for additional information.
    case 422:
        // Sorry, what was your question?
        break;
    // 429 Your request has been throttled. Refer to the Rate Limiting section for details.
    case 429:
        // Hey McLightning, there's a speed limit here!
        break;
    // 500 There was a server error. Contact support@getharvest.com for help.
    case 500:
        // Houston, we have a problem.
        break;
    // Unknown status code
    default:
        break;
}
```



