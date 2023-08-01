# Sentry

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg)](https://php.net/)

Sentry integration as a Spryker monitoring implementation

A Sentry monitoring extension for Spryker, refer to https://sentry.io/

### Install package
```
composer req valantic-spryker-eco/sentry
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
