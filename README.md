
# Webit Developer Alert

Install package

```php
  composer require webit_be/developer_alert
```

Publish config.php file
```php
  php artisan vendor:publish --provider="webit_be\developer_alert\DeveloperAlertServiceProvider" --tag="alert"
```

Publish migrations
```php
  php artisan vendor:publish --provider="webit_be\developer_alert\DeveloperAlertServiceProvider" --tag="migrations"
```

Migrate the database
```php
  php artisan migrate
```
