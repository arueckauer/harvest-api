# Harvest API

**Important: This package is under development and thus neither fully implemented or tested. Not production ready!**

Harvest 2 API using OAuth access tokens

Please see <https://github.com/arueckauer/harvest-api> for background information.

## Getting Started

### Install via composer

```composer require arueckauer/harvest-api```

## Usage

There's nothing you could have done, Luke, had you been there. You'd have been killed, too, and the droids would be in the hands of the Empire.

## Test

Let me see your identification. You don't need to see his identification. We don't need to see his identification.

## License

MIT License. See [LICENSE](LICENSE)

## Contributing

Seventeen thousand! Those guys must really be desperate. This could really save my neck. Get back to the ship and get her ready.

### Submitting Bugs

Close up formation. You'd better let her loose. Almost there! I can't hold them! It's away! It's a hit! Negative. Negative! It didn't go in. It just impacted on the surface.

### Pull requests

No, my father didn't fight in the wars. He was a navigator on a spice freighter. That's what your uncle told you. He didn't hold with your father's ideals.

## Acknowledgements

This package is heavily inspired by [bestit/harvest-api](https://github.com/bestit/harvest-api), which at the time of development supported Harvest API V1.

## Todo

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



