<?php
/**
 * Container.php
 *
 * @package         Obfuscator
 * @subpackage      Container
 */

namespace Naneau\Obfuscator;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Container
 *
 * DI container setup for obfuscator
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      Container
 */
class Container
{
    /**
     * the container
     *
     * @var ContainerBuilder
     */
    private $container;

    /**
     * Constructor
     *
     * @return void
     **/
    public function __construct()
    {
        $this->setContainer(new ContainerBuilder());

        $this->loadFile(__DIR__ . '/Resources/services.yml');
    }

    /**
     * Load a yaml config file
     *
     * @param string $file
     * @return Container
     **/
    public function loadFile($file)
    {
        $loader = new YamlFileLoader(
            $this->getContainer(),
            new FileLocator(dirname($file))
        );
        $loader->load(basename($file));

        return $this;
    }

    /**
     * Get the container
     *
     * @return ContainerBuilder
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set the container
     *
     * @param ContainerBuilder $container
     * @return Container
     */
    public function setContainer(ContainerBuilder $container)
    {
        $this->container = $container;

        return $this;
    }
}
