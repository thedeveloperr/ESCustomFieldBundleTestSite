<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

  /**
   * Generates the configuration tree builder.
   *es_client: <service_id_esclient>
  Doctrine_client: : <service_id_doctrine>
  index_name: <string name>
  es_settings:
  dynamic: false
  number_of_shards: <count>

   * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('sbcamp_custom_fields');

    $rootNode
      ->children()
        ->arrayNode('datatype_limits')
          ->children()
            ->integerNode('text')->min(0)->end()
            ->integerNode('keyword')->min(0)->end()
            ->integerNode('long')->min(0)->end()
            ->integerNode('integer')->min(0)->end()
            ->integerNode('short')->min(0)->end()
            ->integerNode('byte')->min(0)->end()
            ->integerNode('double')->min(0)->end()
            ->integerNode('float')->min(0)->end()
            ->integerNode('half_float')->min(0)->end()
            ->integerNode('scaled_float')->min(0)->end()
            ->integerNode('date')->min(0)->end()
            ->integerNode('boolean')->min(0)->end()
            ->integerNode('boolean')->min(0)->end()
            ->integerNode('integer_range')->min(0)->end()
            ->integerNode('float_range')->min(0)->end()
            ->integerNode('date_range')->min(0)->end()
            ->integerNode('long_range')->min(0)->end()
            ->integerNode('double_range')->min(0)->end()
            ->integerNode('geo_point')->min(0)->end()
            ->integerNode('completion')->min(0)->end()
            ->integerNode('ip')->min(0)->end()
          ->end()

        ->end()
        ->scalarNode('es_client_service_id')->end()
        ->arrayNode('hosts')
          ->performNoDeepMerging()
          ->prototype('scalar')->end()
        ->end()
  //      ->scalarNode('doctrine_client_service_id')->end()
  //      es_index_settings:
  //        dynamic: false
  //        number_of_shards: <count>

      ->end()
    ;
    return $treeBuilder;
  }
}