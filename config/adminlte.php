<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Restaurant Name',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Restaurant name</b>',

    'logo_mini' => '<b>R</b>N',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */


    'menu' => [
        '',
        [
            'text' => 'Add a product',
            'url'  => '/restaurantpanel',
            'icon' => 'shopping-cart',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],
        [
            'text' => 'Add custom title/colors/image',
            'url'  => '/front-page-title',
            'icon' => 'info-circle',
            'icon_color' => 'primary',
            'can' => 'see-admin-menu'
        ],
        [
            'text' => 'Add About infos',
            'url'  => '/add-about-page',
            'icon' => 'info-circle',
            'icon_color' => 'primary',
            'can' => 'see-admin-menu'
        ],
        [
            'text' => 'Create an Invoice',
            'url'  => '/create-invoice',
            'icon' => 'dollar',
            'icon_color' => 'primary',
            'can' => 'see-admin-menu'
        ],
        [
            'text' => 'Create a Sale',
            'url'  => '/sales',
            'icon' => 'dollar',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],
        [
            'text' => 'Add a title for the special\'s page',
            'url'  => '/add-holiday-title',
            'icon' => 'shopping-cart',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],
        [
            'text'        => 'View sales',
            'url'         => '/panel',
            'icon'        => 'dollar',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],
        [
            'text'        => 'View analytics',
            'url'         => '/analytics',
            'icon'        => 'dollar',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],
        [
            'text'        => 'Search an order',
            'url'         => '/search-orders',
            'icon'        => 'search',
            'icon_color' => 'info',
            'can' => 'see-employee-menu'
        ],
        [
            'text'        => 'Today\'s orders',
            'url'         => '/customer-orders',
            'icon'        => 'info-circle',
            'icon_color' => 'success',
            'label' => '',
            'label_color' => 'info',
            'can' => 'see-employee-menu'
        ],
        [
            'text'       => 'Best Customers',
            'url'        => '/best-customers',
            'icon'       => 'plus',
            'icon_color' => 'success',
            'can' => 'see-admin-menu'
        ],

        [
            'text'    => 'Add options/Categories',
            'icon'    => 'share',
            'icon_color' => 'aqua',
            'can' => 'see-admin-menu',
            'submenu' => [
                [
                    'text' => 'Add an option group',
                    'url'  => '/option-group',
                    'icon' => 'glyphicon glyphicon-option-horizontal',
                    'icon_color' => 'green',
                ],
                [
                    'text'       => 'Add options',
                    'url'        => '/add-options',
                    'icon_color' => 'aqua',

                ],
                [
                    'text' => 'Add a second option group',
                    'url'  => '/second-option-group',
                    'icon' => 'glyphicon glyphicon-option-horizontal',
                    'icon_color' => 'green',
                ],
                [
                    'text'       => 'Add second options',
                    'url'        => '/add-second-options',
                    'icon_color' => 'aqua',

                ],
                [
                    'text'       => 'Add a category',
                    'url'        => '/add-category',
                    'icon_color' => 'success',
                ],
                [
                    'text'       => 'Create a Coupon',
                    'url'        => '/create-coupon',
                    'icon_color' => 'aqua',
                ],
            ],
        ],
        [
            'text'    => 'Booking / appointments',
            'url'  => '/calendar',
            'icon'    => 'calendar-plus-o',
            'icon_color' => 'green',
            'label' => '',
            'label_color' => 'info',
            'can' => 'see-employee-menu'
        ],
        [
            'text'    => 'Messages',
            'url'  => '/contact-us',
            'icon'    => 'envelope',
            'icon_color' => 'green',
            'label'       => '',
            'label_color' => 'success',
            'can' => 'see-admin-menu'
        ],

        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => '/edit/profile',
            'icon' => 'user',
            'icon_color' => 'success',
        ],
        [
            'text'    => 'Add/Delete Employees',
            'icon'    => 'share',
            'icon_color' => 'aqua',
            'can' => 'see-admin-menu',
            'submenu' => [
                [
                    'text' => 'Add an Employee',
                    'url'  => '/add-user',
                    'icon' => 'user',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Users/Employees',
                    'url'  => '/delete-user',
                    'icon' => 'user',
                    'icon_color' => 'danger'
                ],
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
    ],
];
