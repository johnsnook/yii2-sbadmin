<?php

/**
 * @author John Snook
 * @description main layout for sbadmin
 * @example to toggle fixed or static navbar, add or remove 'fixed-top' from nav
 *
 *
 * @var $this \yii\web\View
 */
use johnsnook\sbadmin\widgets\NavBar;
use johnsnook\sbadmin\widgets\Nav;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => ['site/index'],
    'options' => ['id' => 'mainNav', 'class' => 'navbar navbar-expand-lg navbar-dark bg-dark fixed-top bg-red'],
    'renderInnerContainer' => false,
    'containerOptions' => ['class' => 'collapse navbar-collapse', 'id' => 'navbarResponsive'],
]);
echo Nav::widget([
    'options' => [
        'id' => 'exampleAccordion',
        'class' => 'navbar-nav flex-column navbar-sidenav',
    ],
    'items' => [
        ['label' => 'Dashboard', 'url' => ['sbadmin/pages', 'name' => 'index'],
            'icon' => 'dashboard', "options" => ['data-toggle' => "tooltip",
                'data-placement' => "right", 'title' => "Dashboard"]],
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
                ['label' => 'Third Level', 'menuOptions' => [
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
echo Nav::widget([
    'options' => [
        'class' => 'sidenav-toggler',
    ],
    'items' => [
        ['label' => null, 'linkOptions' => ['id' => 'sidenavToggler'], 'icon' => 'angle-left']
    ]
]);
?>
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
                <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <strong>David Miller</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <strong>Jane Smith</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <strong>John Doe</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
                <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-danger">
                    <strong>
                        <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
        </div>
    </li>
    <li class="nav-item">
        <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for...">
                <span class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
    </li>
</ul>
<!--</div>-->
<?php
NavBar::end();
?>