# PageSpeed Insights API

API wrapper for PHP to run audits through the Google PageSpeed Insights API.

## Instantiation

The [`PageExperience\PageSpeed\PageSpeedInsightsApi`](/src/PageSpeed/PageSpeedInsightsApi.php) can be directly instantiated by invoking its constructor.

It supports two arguments:

| name | description |
| ---- | ----------- |
| **`$key`** | Required. The Google API key to use for authenticating the requests to the PageSpeed Insights API |
| **`$remoteGetRequest`** | Optional. The [`AmpProject\RemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteGetRequest.php) instance to use for managing remote requests to the Google API server. |

If no `$remoteGetRequest` instance is provided, the library will instantiate an instance of type [`AmpProject\RemoteRequest\CurlRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteGetRequest/CurlRemoteGetRequest.php) to do regular, uncached requests through the PHP `curl` extension.

```php
use PageExperience\PageSpeed\PageSpeedInsightsApi;

$psiApi = new PageSpeedInsightsApi($apiKey);
```

## Usage

Once instantiated, you can execute an audit request via the `PageExperience\PageSpeed\PageSpeedInsightsApi::audit()` method.

The `audit()` method accepts three arguments:

| name | description |
| ---- | ----------- |
| **`$url`** | Required. The Google API key to use for authenticating the requests to the PageSpeed Insights API |
| **`$strategy`** | Optional. The device strategy to use for the audit. Can be one of `'mobile'`, `'desktop'`. Defaults to `'mobile'`. |
| **`$referrer`** | Optional. The referrer string to use when requesting the audit. The referrer might be checked for some API keys. Defautls to an empty string. |

```php
$psiApi->audit('https://example.com/landing-page', 'mobile', 'https://example.com');
```

## Adapting the Handling of Remote Requests

The implementation to use for fulfilling requests made via the [`AmpProject\RemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteGetRequest.php) interface can be injected into the [`PageExperience\PageSpeed\PageSpeedInsightsApi`](/src/PageSpeed/PageSpeedInsightsApi.php) via its second, optional argument:

```php
use PageExperience\PageSpeed\PageSpeedInsightsApi;

$psiApi = new PageSpeedInsightsApi(
	$apiKey,

	// A custom implementation that lets you control how remote requests are handled.
	new MyCustomRemoteGetRequestImplementation()
);
```

If this optional second argument is not provided when instancing the page speed API wrapper, the default [`AmpProject\RemoteRequest\CurlRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteRequest/CurlRemoteGetRequest.php) implementation is used.

There are other implementations already provided that can be useful:

| Class (short name) | Description |
|-------|-------------|
| [`CurlRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteRequest/CurlRemoteGetRequest.php) | Remote request transport using cURL. This is the default implementation that will be used if you don't provide one explicitly.<br><br>It has the following configuration settings as constructor arguments:<br>**$sslVerify** - Whether to verify SSL certificates. Defaults to true.<br>**$timeout** - Timeout value to use in seconds. Defaults to 10.<br>**$retries** - Number of retry attempts to do if an error code was thrown that is worth retrying. Defaults to 2. |
| [`FallbackRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteRequest/FallbackRemoteGetRequest.php) | Fallback pipeline implementation to go through a series of fallback requests until a request succeeds. The request will be tried with the first instance provided, and follow the instance series from one to the next until a successful response was returned.<br><br>It has the following configuration settings as constructor arguments:<br>**...$pipeline** - Variadic array of RemoteGetRequest instances to use as consecutive fallbacks. |
| [`FilesystemRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteRequest/FilesystemRemoteGetRequest.php) | Fetch the response for a remote request from the local filesystem instead. This can be used to provide offline fallbacks.<br><br>It has the following configuration settings as constructor arguments:<br>**$argumentMap** - Associative array of data for mapping between provided URLs and the filepaths they should map to. |
| [`StubbedRemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteRequest/StubbedRemoteGetRequest.php) | Stub for simulating remote requests. This is mainly used for writing tests.<br><br>It has the following configuration settings as constructor arguments:<br>**$argumentMap** - Associative array of data for mapping between provided URLs and the body content they should return. |

To build your own transport, you'll need to implement the [`AmpProject\RemoteGetRequest`](https://github.com/ampproject/amp-toolbox-php/blob/main/src/RemoteGetRequest.php) interface. For a more involved example of a custom transport or for integrating with your stack of choice, see the two implementations provided by the `Page Experience for WordPress` WordPress plugin:

- [`AmpProject\AmpWP\RemoteRequest\CachedRemoteGetRequest`](https://github.com/ampproject/amp-wp/blob/develop/src/RemoteRequest/CachedRemoteGetRequest.php)
- [`AmpProject\AmpWP\RemoteRequest\WpHttpRemoteGetRequest`](https://github.com/ampproject/amp-wp/blob/develop/src/RemoteRequest/WpHttpRemoteGetRequest.php)
