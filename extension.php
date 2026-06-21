<?php

declare(strict_types=1);

/*
 * Optional Studio extension runtime entry point.
 *
 * Studio may include this file only after extension validation and activation.
 * Replace this placeholder with documented contribution objects when the
 * extension needs runtime contributions such as settings, view injections,
 * providers, hooks, scheduler tasks, or other supported contracts.
 *
 * Keep discovery side-effect free: do not read/write files, spawn processes,
 * open network connections, inspect raw request/environment globals, or load
 * extension code outside documented Studio extension points here.
 */

use App\Core\Extension\Settings\ExtensionSettingDefinition;
use App\Form\FormInputType;
use App\View\Injection\ConfigurableStaticViewInjectionRoute;
use App\View\Injection\ConfigurableStaticViewInjectionSet;
use App\View\Injection\DynamicViewInjection;
use App\View\Injection\DynamicViewInjectionFilter;
use App\View\Injection\DynamicViewInjectionSlot;
use App\View\Injection\ViewSurface;

return [
    new ConfigurableStaticViewInjectionSet(
        'demo-module',
        'demo.route',
        ViewSurface::Public,
        'demo',
        [
            new ConfigurableStaticViewInjectionRoute(
                'ext-demo-module-public-demo',
                '',
                'ext.demo-module.navigation.demo',
                '@frontend/demo-module/frontend.html.twig',
                sortOrder: 700,
            ),
            new ConfigurableStaticViewInjectionRoute(
                'ext-demo-module-public-typography',
                'typography',
                'ext.demo-module.navigation.typography',
                '@frontend/demo-module/typography.html.twig',
                sortOrder: 730,
            ),
        ],
    ),
    new DynamicViewInjection(
        'ext-demo-module-after-content',
        ViewSurface::Public,
        DynamicViewInjectionSlot::AfterContent,
        '@frontend/demo-module/after-content.html.twig',
        DynamicViewInjectionFilter::realContent(),
        sortOrder: 700,
        label: 'ext.demo-module.dynamic.after_content.label',
    ),
    new ExtensionSettingDefinition(
        'demo-module',
        'display.mode',
        'ext.demo-module.settings.display_mode.label',
        'expanded',
        description: 'ext.demo-module.settings.display_mode.help',
        options: [
            'compact' => 'ext.demo-module.settings.display_mode.options.compact',
            'expanded' => 'ext.demo-module.settings.display_mode.options.expanded',
        ],
        inputType: FormInputType::Select,
    ),
    new ExtensionSettingDefinition(
        'demo-module',
        'demo.route',
        'ext.demo-module.settings.demo_route.label',
        'demo',
        description: 'ext.demo-module.settings.demo_route.help',
        inputType: FormInputType::Text,
        validation: ['required' => true, 'pattern' => '^[a-z0-9][a-z0-9\/-]*$'],
        sortOrder: 10,
    ),
];
