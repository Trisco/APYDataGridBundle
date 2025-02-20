<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Abhoryo <abhoryo@free.fr>
 * (c) Stanislav Turza
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APY\DataGridBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class APYDataGridExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container):void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('columns.xml');

        $ymlLoader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $ymlLoader->load('grid.yml');

        $container->setParameter('apy_data_grid.limits', $config['limits']);
        $container->setParameter('apy_data_grid.theme', $config['theme']);
        $container->setParameter('apy_data_grid.persistence', $config['persistence']);
        $container->setParameter('apy_data_grid.no_data_message', $config['no_data_message']);
        $container->setParameter('apy_data_grid.no_result_message', $config['no_result_message']);
        $container->setParameter('apy_data_grid.actions_columns_size', $config['actions_columns_size']);
        $container->setParameter('apy_data_grid.actions_columns_title', $config['actions_columns_title']);
        $container->setParameter('apy_data_grid.pagerfanta', $config['pagerfanta']);
    }
}
