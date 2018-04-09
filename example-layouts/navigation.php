<?php

/**
 * @author John Snook
 * @description main layout for sbadmin, using pure Yii2 method.  I had to write
 * my own widgets to do it, however.
 * @example to toggle fixed or static navbar, add or remove 'fixed-top' from nav
 *
 *
 * @var $this \yii\web\View
 */
use johnsnook\sbadmin\widgets\NavBar;
use johnsnook\sbadmin\widgets\Nav;

use johnsnook\sbadmin\FakeData;

echo '<!-- Begin NavBar.  Contains the brand link, the collapsed menu button and ' . PHP_EOL
 . 'the collapsible div whick contains the Nav items.-->' . PHP_EOL;
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => ['site/index'],
    'options' => ['id' => 'mainNav', 'class' => 'navbar navbar-expand-lg navbar-dark bg-dark fixed-top '],
    'renderInnerContainer' => false,
    'containerOptions' => ['class' => 'collapse navbar-collapse', 'id' => 'navbarResponsive'],
]);
echo '<!-- Start side Nav-->' . PHP_EOL;
echo Nav::widget([
    'options' => [
        'id' => 'exampleAccordion',
        'class' => 'navbar-nav flex-column navbar-sidenav',
        'style' => ['margin-top' => '70px']
    ],
    'items' => [
        [
            'label' => 'Dashboard',
            'url' => ['sbadmin/pages', 'name' => 'index'],
            'icon' => 'dashboard',
            "options" => [
                'data-toggle' => "tooltip",
                'data-placement' => "right",
                'title' => "Dashboard"
            ]],
        ['label' => 'charts', 'icon' => 'area-chart', 'url' => ['sbadmin/pages', 'name' => 'charts']],
        ['label' => 'tables', 'icon' => 'table', 'url' => ['sbadmin/pages', 'name' => 'tables']],
        ['label' => 'Components', 'icon' => 'wrench', 'menuOptions' => [
                'class' => 'sidenav-second-level',
                'type' => Nav::MENU_TYPE_ACCORDION
            ],
            'items' => [
                ['label' => 'Navbar', 'url' => ['sbadmin/pages', 'name' => 'navbar']],
                ['label' => 'cards', 'url' => ['sbadmin/pages', 'name' => 'cards']],
            ]
        ],
        ['label' => 'Example Pages', 'icon' => 'file', 'menuOptions' => [
                'class' => 'sidenav-second-level',
                'type' => Nav::MENU_TYPE_ACCORDION
            ],
            'items' => [
                ['label' => 'Login Page', 'url' => ['sbadmin/pages', 'name' => 'login']],
                ['label' => 'Registration Page', 'url' => ['sbadmin/pages', 'name' => 'register']],
                ['label' => 'Forgot Password Page', 'url' => ['sbadmin/pages', 'name' => 'forgot-password']],
                ['label' => 'Blank', 'url' => ['sbadmin/pages', 'name' => 'blank']],
            ]
        ],
        ['label' => 'Menu Levels', 'icon' => 'sitemap', 'menuOptions' => [
                'class' => 'sidenav-second-level',
                'type' => Nav::MENU_TYPE_ACCORDION
            ],
            'items' => [
                ['label' => 'second level item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 1]],
                ['label' => 'second level item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 2]],
                ['label' => 'second level item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 3]],
                [
                    'label' => 'Third Level',
                    'menuOptions' => [
              'class' => 'sidenav-third-level',
                        'type' => Nav::MENU_TYPE_ACCORDION
                    ],
                    'items' => [
                        ['label' => 'Third Level Item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 4]],
                        ['label' => 'Third Level Item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 5]],
                        ['label' => 'Third Level Item', 'url' => ['sbadmin/pages', 'name' => 'blank', 'unique' => 6]],
                    ]
                ],
            ],
        ],
        ['label' => 'Link', 'icon' => 'link'],
    ],
]);
echo '<!-- End side Nav-->' . PHP_EOL;

echo '<!-- Start toggle button Nav.  If nav top is fixed, it\'s under the sidenav, ' . PHP_EOL
 . 'if nav top is static, it\'s at the top. -->' . PHP_EOL;
echo Nav::widget([
    'options' => [
        'class' => 'sidenav-toggler',
    ],
    'items' => [
        ['label' => null, 'linkOptions' => ['id' => 'sidenavToggler', 'class' => 'text-center'], 'icon' => 'angle-left']
    ]
]);
echo '<!-- End toggle button Nav -->' . PHP_EOL;

$msgsItems = [
    /** with no url or subitems, this becomes a header */
    ['label' => 'New Messages'],
    /** empties are dividers */
    [],
];

/** Build the messeges menu with some fake data */
foreach (FakeData::getMessages() as $msg) {
    #die(json_encode($msg));
    $msgsItems[] = [
        'url' => 'javascript:;',
        'label' => "<strong>{$msg['from']}</strong>
                <span class=\"small float-right text-muted\">{$msg['time']}</span>
                <div class=\"dropdown-message small\">{$msg['message']}</div>"
    ];
    $msgsItems[] = [];
}
$msgsItems[] = [
    'label' => 'View all messages...',
    'url' => 'javascript:;',
    'class' => 'small'
];

$alertItems = [
    ['label' => 'New Alerts'], /**  header */
    [], /** divider */
];

/** Build the alerts menu with some fake data */
foreach (FakeData::getAlerts() as $alert) {
    #die(json_encode($msg));
    $alertItems[] = [
        'url' => 'javascript:;',
        'label' => '<span class = "text-' . ($alert['good'] ? 'success' : 'danger') . '">'
        . '<strong><i class = "fa fa-long-arrow-' . ($alert['good'] ? 'up' : 'down') . ' fa-fw"></i>'
        . "{$alert['status']}</strong></span>"
        . '<span class = "small float-right text-muted">' . "{$alert['time']}</span>"
        . '<div class = "dropdown-message small">' . "{$alert['message']}</div>"
    ];
    $alertItems[] = [];
}
$alertItems[] = [
    'label' => 'View all alerts...',
    'url' => 'javascript:;',
    'class' => 'small'
];

echo '<!-- Start top Nav.  Containsts 2 dropdowns, a form and nav-link. -->' . PHP_EOL;
echo Nav::widget([
    'encodeLabels' => false,
    'options' => [
        'class' => 'ml-auto',
    ],
    'items' => [
        [
            'linkOptions' => [
                'id' => 'messagesDropdown',
                'class' => 'mr-lg-2',
            ],
            'encode' => false,
            #<i class="fa fa-fw fa-envelope"></i>
            'icon' => 'envelope',
            'label' => '<span class="d-lg-none">Messages
                    <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>',
            'menuOptions' => [
                'type' => Nav::MENU_TYPE_DROPDOWN
            ],
            'items' => $msgsItems
        ],
        [
            'linkOptions' => [
                'id' => 'alertsDropdown',
                'class' => 'mr-lg-2',
            ],
            'encode' => false,
            'icon' => 'bell',
            'label' => '<span class = "d-lg-none">Alerts
                <span class = "badge badge-pill badge-warning">6 New</span>
            </span>
            <span class = "indicator text-warning d-none d-lg-block">
                <i class = "fa fa-fw fa-circle"></i>
            </span>',
            'menuOptions' => [
                'type' => Nav::MENU_TYPE_DROPDOWN
            ],
            'items' => $alertItems
        ],
        '<li class="nav-item">
            <form class = "form-inline my-2 my-lg-0 mr-lg-2">
                <div class = "input-group">
                    <input class = "form-control" type = "text" placeholder = "Search for...">
                    <span class = "input-group-append">
                        <button class = "btn btn-primary" type = "button">
                            <i class = "fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </li>',
        [
            'label' => 'logout',
            'icon' => 'sign-out',
            'linkOptions' => [
                'data-toggle' => 'modal',
                'data-target' => '#exampleModal',
            ]
        ]
    ]
]);
echo '<!-- End top Nav -->' . PHP_EOL;
NavBar::end();
echo '<!-- End of NavBar. -->' . PHP_EOL;
