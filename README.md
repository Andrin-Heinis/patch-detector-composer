# Patch Risk Detector

[![Packagist](https://img.shields.io/packagist/v/aheinis/patch-risk-detector.svg)](https://packagist.org/packages/aheinis/patch-risk-detector)  
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

🔍 A Composer plugin that detects risky and safe patches.

## 📦 Installation

You can install the package via Composer:
``` bash
composer require aheinis/patch-risk-detector
```

For development or local testing:
``` bash
composer require aheinis/patch-risk-detector --dev
```


## 🚀 Usage

Once installed, the plugin automatically integrates with Composer and detects patch risks.

Example command:
``` bash
composer patch-risk-detect
```


## 🔧 Configuration

If needed, you can configure the plugin using `composer.json`:
``` bash
{ "extra": { "patch-risk-detector": { "log_level": "warning" } } }
```

## 🛠 Development

If you want to modify or contribute to the plugin:

1. Clone the repository:
``` bash
git clone https://github.com/Andrin-Heinis/patch-risk-detector.git cd patch-risk-detector
```
2. Install dependencies
3. Run local tests

## 🤝 Contributing

Pull requests are welcome! If you find any issues or want to suggest features, please open an [Issue](https://github.com/Andrin-Heinis/patch-risk-detector/issues).
