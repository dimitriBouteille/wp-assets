# Wordpress Assets

Librairie Wordpress permettant de gérer les assets. 

### Configuration minimale

- PHP >= 7.2
- Wordpress >= 3.2
- [Composer](https://getcomposer.org/)

### Installation

```bash
composer require dbout/wp-assets
```

### Utilisation

```php
use Dbout\WpAssets\Asset\Style;
use Dbout\WpAssets\Asset\Script;

(new Style('my-style', get_stylesheet_directory_uri() . 'app.css'))->register();
(new Script('my-script', get_stylesheet_directory_uri() . 'app.js'))->register();
```