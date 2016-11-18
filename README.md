# IAM Sample Client in PHP

## Prerequisite

- Docker

or

- Apache and PHP stack

In addition to the aforementioned development dependencies, you will need the following:

- Client ID / Secret
- Client authorized to access api.cimpress.io
- Permissions configured in IAM

## Getting Started

Populate a `config.ini` file in the project's directory:

```
$ cat > config.ini <<EOF
CLIENT_ID=<client-id>
CLIENT_SECRET=<client-secret>
EOF
```

Run the PHP Docker image
```
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.0-cli php sample.php
```
