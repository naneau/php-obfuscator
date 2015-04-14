# PHP Obfuscator

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/naneau/php-obfuscator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/naneau/php-obfuscator/?branch=master)

This is an "obfuscator" for PSR/OOp PHP code. Different from other obfuscators, which often use a (reversible) `eval()` based obfuscation, this tool actually [parses PHP](https://github.com/nikic/PHP-Parser), and obfuscates variable names, methods, etc. This means is can not be reversed by tools such as [UnPHP](http://www.unphp.net).

This library was written out of the need to obfuscate the source for a private library which for various reasons could not be shared without steps to protect the source from prying eyes. It is not technically feasible to "encrypt" PHP source code, while retaining the option to run it on a standard PHP runtime. Tools such as [Zend Guard](http://www.zend.com/products/guard) use run-time plugins, but even these offer no real security.

While this tool does not make PHP code impossible to read, it will make it significantly less legible.

It is compatible with PHP 5.3, 5.4 and 5.5, but needs PHP 5.4+ to run.

## Usage

After cloning this repository (`git clone https://github.com/naneau/php-obfuscator`) and installing the dependencies through Composer (`composer install`), run the following command to obfuscate a directory of PHP files:

```bash
./bin/obfuscate obfuscate /input/directory /output/directory
```

If you've installed this package through [Composer](https://getcomposer.org), you'll find the `obfuscate` command in the relevant [bin dir](https://getcomposer.org/doc/articles/vendor-binaries.md).

### Configuration

You may find that you'll need to prevent certain variables and methods from being renamed. In this case you can create a simple YAML configuration file

```yaml
parameters:

    # Ignore variable names
    obfuscator.scramble_variable.ignore:
        - foo
        - bar
        - baz

    # Ignore certain methods names
    obfuscator.scramble_private_method.ignore:
        - foo
        - bar
        - baz
```

You can run the obfuscator with a configuration file through

```bash
./bin/obfuscate obfuscate /input/directory /output/directory --config=/foo/bar/config.yml
```
