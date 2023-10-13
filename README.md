# API

Web API for the applications.

## Development

### Set-up the environment

```bash
docker compose up
```

### How to add a new namespace

- add the namespace to `composer.json`
- run the following command to update the autoloader:

```bash
composer dump-autoload
```
