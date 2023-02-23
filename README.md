[<img src="/htdocs/wp-content/themes/wpkit/screenshot.png" width="350"/>](/htdocs/wp-content/themes/wpkit/screenshot.png)
# WPkit
A lightweight and modular Wordpress-Kit for developing fast and powerful, based on UIkit and _s/underscores.

------------

## Dependency Support

- _s/underscores starter theme: https://github.com/automattic/_s
- UIkit front-end framework: https://github.com/uikit/uikit
- WordPress multi-environment config: https://github.com/studio24/wordpress-multi-env-config

## How to start

1. Clone the repo: `git clone git@github.com:whydesign/WPkit.git`
2. Edit your default configs in `/wp-config/wp-config.default.php`
3. Rename `/wp-config/wp-config.env.php-example` to `/wp-config/wp-config.env.php` and set your environments
4. Add your `wp-config.{ENV}.php` (e.g. `wp-config.local.php`) and edit your data
5. Change directorie to `/htdocs/wp-content/themes/wpkit` and run `npm install`