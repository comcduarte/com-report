<?php
namespace Report\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Report\Controller\ReportConfigController;

class ReportConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new ReportConfigController();
        $controller->setDbAdapter($container->get('report-model-adapter'));
        return $controller;
    }
}