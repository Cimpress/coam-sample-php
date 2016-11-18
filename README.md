# IAM Sample Client in PHP

## Prerequisite

- Docker

or

- Apache and PHP stack

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
