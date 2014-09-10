# PHP Obfuscator

This is an "obfuscator" for PSR/OOp PHP code. Different from other obfuscators, which often use a (reversible) `eval()` based obfuscation, this tool actually [parses PHP](https://github.com/nikic/PHP-Parser), and obfuscates variable names, methods, etc. This means is can not be reversed by tools such as [UnPHP](http://www.unphp.net).

This library was written out of the need to obfuscate the source for a private library which for various reasons could not be shared without steps to protect the source from prying eyes. It is not technically feasible to "encrypt" PHP source code, while retaining the option to run it on a standard PHP runtime. Tools such as [Zend Guard](http://www.zend.com/products/guard) use run-time plugins, but even these offer no real security.

While this tool does not make PHP code impossible to read, it will make it significantly less legible.

It is compatible with PHP up to and including 5.5.

## Usage

After cloning this repository (`git clone https://github.com/naneau/php-obfuscator`), run the following command to obfuscate a directory of PHP files:

```bash
./obfuscate obfuscate /input/directory /output/directory
```

### Configuration

You may find that you'll need to prevent certain variables and methods from being renamed. In this case you can create a simple YAML configuration file

```yaml
parameters:

    # Ignore variable names
    obfuscator.node_visitor.scramble_variable.ignore:
        - foo
        - bar
        - baz

    # Ignore certain methods names
    obfuscator.node_visitor.scramble_private_method.ignore:
        - foo
        - bar
        - baz
```

You can run the obfuscator with a configuration file through

```bash
./obfuscate obfuscate /input/directory /output/directory --config=/foo/bar/config.yml
```
