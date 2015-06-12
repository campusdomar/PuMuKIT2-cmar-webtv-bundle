<?php

namespace Pumukit\Cmar\WebTVBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pumukit_cmar_web_tv');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
          ->children()
            ->scalarNode('cas_url')->isRequired()
              ->info('The hostname of the CAS server')
            ->end()
            ->scalarNode('cas_port')->isRequired()
              ->info('The port the CAS server is running on')
            ->end()
            ->scalarNode('cas_uri')->isRequired()
              ->info('The URI the CAS server is responding on')
            ->end()
            ->arrayNode('cas_allowed_ip_clients')->isRequired()->requiresAtLeastOneElement()
              ->prototype('scalar')
              ->info('Array of allowed IP clients')
            ->end()
          ->end()
          ;

        return $treeBuilder;
    }
}
