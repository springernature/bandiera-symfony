<?php

namespace SpringerNature\Symfony\Bandiera\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BandieraExtension extends Extension
{
    /**
     * {@inheritDoc}
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $processedConfiguration = $this->processConfiguration($configuration, $configs);

        $clientDefinition = $container->getDefinition('Nature\Bandiera\Client');
        $clientDefinition->replaceArgument(0, $configs['bandiera']['url']);

        $twigFunctionDefiniation = $container->getDefinition('SpringerNature\Symfony\Bandiera\Twig\FeatureFlags');
        $twigFunctionDefiniation->replaceArgument(0, $configs['bandiera']['group']);
    }
}
