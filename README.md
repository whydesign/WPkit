[<img src="/htdocs/wp-content/themes/wpkit/screenshot.png" width="350"/>](/htdocs/wp-content/themes/wpkit/screenshot.png)
# WPkit
A lightweight and modular Wordpress-Kit for developing fast and powerful, based on UIkit and _s/underscores.

------------

## Dependency Support

- _s/underscores starter theme: https://github.com/automattic/_s
- UIkit front-end framework: https://github.com/uikit/uikit
- WordPress multi-environment config: https://github.com/studio24/wordpress-multi-env-config

## How to start

### Basic Setup
1. Clone the repo: `git clone git@github.com:whydesign/WPkit.git`
2. Run `./setup.sh files`
3. Edit your environment configs in `/wp-config/wp-config.env.php` and `/wp-config/wp-config.local.php`
    - Optional: *add your `wp-config.{ENV}.php` (e.g. `wp-config.staging.php`) and edit your data*
4. Edit setup configs in `setup-cnf.sh` and `.my.cnf`
5. Run `./setup.sh install`
    - Optional: *Import starter SQL dump by answer with `y` or run `./setup.sh import`*
    
### Additional Setup Options

See all command with `./setup.sh help`

1. Install WP-CLI by running `./setup.sh wpcli-install`
2. Update WP-CLI by running `./setup.sh wpcli-update`
2. Show WP-CLI infos by running `./setup.sh wpcli-info`

You want more infos about WP-CLI?

- WP-CLI Website: [wp-cli.org](https://wp-cli.org/ "wp-cli.org")
- WP-CLI GitHub Page: [github.com/wp-cli/wp-cli](https://github.com/wp-cli/wp-cli/ "github.com/wp-cli/wp-cli")
- Wordpress Developer Resources: [developer.wordpress.org/cli/commands](https://developer.wordpress.org/cli/commands/ "developer.wordpress.org/cli/commands")