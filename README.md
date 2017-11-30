# CakePHP boilerplate app with docker-compose

## Setting up

Check out this repo and run:
```bash
docker-compose up -d
```

Connect to hack_php7 container and run composer
```bash
docker-exec -i -t hack_php7 /bin/bash
composer install
```

The app should be available at `http:/localhost`.

phpMyAdmin should be available at `http://localhost:8080`.
