<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SbcampCustomFieldsExtension extends Extension {
  /**
   * Loads a specific configuration.
   *
   * @param array            $configs
   * @param ContainerBuilder $container
   *
   * @throws \Exception
   */
  public function load(array $configs, ContainerBuilder $container) {
    $loader = new YamlFileLoader(
      $container,
      new FileLocator(__DIR__ . '/../Resources/config')
    );
    $loader->load('services.yaml');

//    $configuration = new Configuration();
//    $config = $this->processConfiguration($configuration, $configs);
//    echo print_r($config, TRUE);

  }
}