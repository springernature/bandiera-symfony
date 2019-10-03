<?php

namespace SpringerNature\Symfony\Bandiera\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bandiera');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root('bandiera');

        $rootNode->children()
            ->scalarNode('url')
            ->defaultNull()
            ->beforeNormalization()
            ->ifString()
            ->then($this->getTrimClosure());

        $rootNode->children()
             ->scalarNode('group')
             ->defaultNull()
             ->beforeNormalization()
             ->ifString()
             ->then($this->getTrimClosure());

        return $treeBuilder;
    }

    private function getTrimClosure(): \Closure
    {
        return function ($str): ?string {
            $value = trim($str);
            if ($value === '') {
                return null;
            }

            return $value;
        };
    }
}
