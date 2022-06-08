# Sentry

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg)](https://php.net/)

Sentry integration as a Spryker monitoring implementation

A Sentry monitoring extension for Spryker, refer to https://sentry.io/

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

### Install package
```
composer req valantic-spryker/sentry
```

### Update your shared config
```php
$config[KernelConstants::PROJECT_NAMESPACES] = [
    'ValanticSpryker',
    ...
];

$config[SentryConstants::PROJECT_DSN] = '<your sentry project DSN>';
```

### Register monitoring plugin
`src/Pyz/Service/Monitoring/MonitoringDependencyProvider`

```php
...
use ValanticSpryker\Service\Sentry\Plugin\Monitoring\SentryMonitoringExtensionPlugin;
...
protected function getMonitoringExtensions(): array
    {
        return [
            ...
            new SentryMonitoringExtensionPlugin(),
            ...
        ];
    }
```
