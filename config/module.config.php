<?php

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Report\Controller\ReportConfigController;
use Report\Controller\ReportController;
use Report\Controller\Factory\ReportConfigControllerFactory;
use Report\Controller\Factory\ReportControllerFactory;
use Report\Form\ReportForm;
use Report\Form\Factory\ReportFormFactory;
use Report\Service\Factory\ReportModelAdapterFactory;

return [
    'router' => [
        'routes' => [
            'reports' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/reports',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => 'report-controller',
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'config' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => ReportConfigController::class,
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => 'report-controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'admin' => [
            'reports' => [],
            'reports/config' => [],
            'reports/default' => [],
        ],
    ],
    'controllers' => [
        'aliases' => [
            'report-controller' => ReportController::class,
        ],
        'factories' => [
            ReportConfigController::class => ReportConfigControllerFactory::class,
            ReportController::class => ReportControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            ReportForm::class => ReportFormFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            'report' => [
                'label' => 'Reports',
                'route' => 'reports',
                'class' => 'dropdown',
                'order' => 90,
                'resource' => 'reports/default',
                'privilege' => 'menu',
                'pages' => [
                    [
                        'label' => 'Available Reports',
                        'route' => 'reports/default',
                        'resource' => 'reports/default',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                    [
                        'label' => 'Add New Report',
                        'route' => 'reports/default',
                        'resource' => 'reports/default',
                        'action' => 'create',
                        'privilege' => 'create',
                    ],
                ],
            ],
            'settings' => [
                'label' => 'Settings',
                'pages' => [
                    'timecard' => [
                        'label' => 'Report Settings',
                        'route' => 'reports/config',
                        'action' => 'index',
                        'resource' => 'reports/config',
                        'privilege' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'report-model-adapter-config' => 'model-adapter-config',
        ],
        'factories' => [
            'report-model-adapter' => ReportModelAdapterFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/report' => __DIR__ . '/../view/report/layouts/report.phtml',
            'report/context' => __DIR__ . '/../view/report/partials/context_report.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];