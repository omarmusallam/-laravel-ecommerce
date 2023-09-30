<?php

return [
    [
        'icon' => "home",
        'route' => 'dashboard.dashboard',
        'title' => 'Home',
        'active' => 'dashboard.dashboard',
        'ability' => 'admin.dashboard',
    ],
    [
        'icon' => 'category',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view'
    ],
    [
        'icon' => 'store',
        'route' => 'dashboard.stores.index',
        'title' => 'Stores',
        'active' => 'dashboard.stores.*',
        'ability' => 'stores.view',
    ],
    [
        'icon' => 'shop',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view'
    ],
    [
        'icon' => 'local_shipping',
        'route' => 'dashboard.orders.index',
        'title' => 'Orders',
        'badge' => 'New',
        'active' => 'dashboard.orders.*',
        'ability' => 'orders.view'
    ],
    [
        'icon' => 'gavel',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view'
    ],
    [
        'icon' => 'admin_panel_settings',
        'route' => 'dashboard.admins.index',
        'title' => 'Admins',
        'active' => 'dashboard.admins.*',
        'ability' => 'admins.view',
    ],
    [
        'icon' => 'account_box',
        'route' => 'dashboard.users.index',
        'title' => 'Users',
        'active' => 'dashboard.users.*',
        'ability' => 'users.view',
    ],
    [
        'icon' => 'settings',
        'route' => 'dashboard.setting',
        'title' => 'Settings',
        'active' => 'dashboard.setting.*',
        'ability' => 'settings.view',
    ],

];
