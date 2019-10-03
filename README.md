# bandiera-symfony

Symfony integration for [bandiera](https://github.com/springernature/bandiera)

[![MIT licensed][shield-license]][info-license]

## Installation

### Step 1: Download the Bundle

You can install this bundle using [Composer](https://getcomposer.org/): 

```bash
composer require springernature/bandiera-symfony
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:
```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new \SpringerNature\Symfony\Bandiera\BandieraBundle(),
        ];

        // ...
    }

    // ...
}
```

### Step 3: Configuration

Add you [bandiera URL](https://github.com/springernature/bandiera) and group values of your project to ``app/config/config_prod.yml``.


```yaml
bandiera:
    url: "https://public:secret@sentry.example.com/1"
    group: "my_app"
```

## Development

1. Fork this repo.
2. Run `composer install`
3. run `composer run-script test`

# License

[&copy; 2019 Springer Nature](LICENSE.txt).

Bandiera Symfony is licensed under the [MIT License][mit].

[shield-license]: https://img.shields.io/badge/license-MIT-blue.svg
[info-license]: LICENSE
[mit]: http://opensource.org/licenses/mit-license.php
