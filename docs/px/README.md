# PX CLI tool

The `px` binary to run the page experience tooling provided in this repository through the console.

## Basic Usage

To get an overview of how to work with the tool, use the following command:
```sh
bin/px --help
```

To run a specific subcommand, use the following notation (with `<command>` being replaced by the command you want to use):

```sh
bin/px <command>
```

To get help about a specific subcommand, you can use the following notation (with `<command>` being replaced by the command you want to get help on):
```sh
bin/px <command> --help
```

The following subcommands are available:
* **`analyze`** - Run a page experience analysis through the page experience engine.
* **`psi`** - Fetch a performance audit from the remote PageSpeed Insights API.

## Page Experience Engine Analysis (`analyze`)

The page experience analysis can be run with the following command:

```sh
bin/px --json analyze <url>
```

The `<url>` needs to be replaced with the URL of the web page you want to audit.

> Note: Currently the `--json` flag is required and the only supported output format.

> Note: Currently the `--json` flag needs to be used _before_ the `<url>` argument due to a limitation in the CLI parsing algorithm. This will be fixed in a future patch.  

## PageSpeed Insights API Audit (`psi`)

An audit via the PageSpeed Insights API can be requested with the following command:

```sh
bin/px psi [--key=<key>] [--strategy=<strategy>] [--referrer=<referrer>] [--json] <url>
```

The optional `--key=<key>` flag needs to have the `<key>` part replaced with a valid Google API key. If no key is provided, the tool tries to request an audit without authentication. This may work, but often fails due to rate limiting.

The optional `--strategy=<stratgey>` flag needs to have the `<strategy>` part replaced with a device strategy, which can be one of either `mobile` or `desktop`. If no strategy provided, it defaults to `mobile`.

The optional `--referrer=<referrer>` flag needs to have its `<referrer>` part replaced with the referrer to be used for the request. If no referrer is provided, some Google API keys may file as they could be limited to one or more specific referrer.

The `<url>` needs to be replaced with the URL of the web page you want to audit.

> Note: Currently the `--key`, `stratgey`, `--referrer` and `--json` flags need to be used _before_ the `<url>` argument due to a limitation in the CLI parsing algorithm. This will be fixed in a future patch.  
