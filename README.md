Yii 2 Basic shorty url
============================

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      components/         contains application components
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

1) PHP 5.4.0.

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=YOU_DB',
    'username' => 'login',
    'password' => 'password',
    'charset' => 'utf8',
];
```

INSTALLATION
------------

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

```php
git clone https://github.com/purgenyo/shorty.git
cd shorty
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
php yii migrate
```
# Server config
#### php server
```bash

sudo php yii serve --port=2929
## or ##
cd web
php -S localhost:820
```

#### or nginx server (simple config)
```
server {
    listen 8080;
    client_max_body_size 32m;

    # NOTE: Replace with your path here
    root /home/sega/my_projects/shorty/web;
    index index.php;

    # NOTE: Replace with your hostname
    server_name shorty.me;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }

    location ~ /\.ht {
       deny all;
    }
}
```

