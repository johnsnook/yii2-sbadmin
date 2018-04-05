
<?php

use johnsnook\sbadmin\VertNav;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/"><?= Yii::$app->name ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php
        echo VertNav::widget([
            'options' => [
                'id' => 'SideMenu',
                'class' => 'navbar-nav flex-column navbar-sidenav',
            ],
            'items' => [
                ['label' => 'Dashboard', 'url' => ['site/pages', 'name' => 'index'], 'icon' => 'dashboard', "options" => ['data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Dashboard"]],
                ['label' => 'charts', 'icon' => 'area-chart', 'url' => ['site/pages', 'name' => 'charts']],
                ['label' => 'tables', 'icon' => 'table', 'url' => ['site/pages', 'name' => 'tables']],
                ['label' => 'Components', 'icon' => 'wrench', 'menuOptions' => ['class' => 'sidenav-second-level'], 'items' => [
                        ['label' => 'Navbar', 'url' => ['site/pages', 'name' => 'navbar']],
                        ['label' => 'cards', 'url' => ['site/pages', 'name' => 'cards']],
                    ]
                ],
                ['label' => 'Example Pages', 'icon' => 'file', 'menuOptions' => ['class' => 'sidenav-second-level'], 'items' => [
                        ['label' => 'Login Page', 'url' => ['site/pages', 'name' => 'login']],
                        ['label' => 'Registration Page', 'url' => ['site/pages', 'name' => 'register']],
                        ['label' => 'Forgot Password Page', 'url' => ['site/pages', 'name' => 'forgot-password']],
                        ['label' => 'Blank', 'url' => ['site/pages', 'name' => 'blank']],
                    ]
                ],
                ['label' => 'Menu Levels', 'icon' => 'sitemap', 'menuOptions' => ['class' => 'sidenav-second-level'], 'items' => [
                        ['label' => 'second level item'],
                        ['label' => 'second level item'],
                        ['label' => 'second level item'],
                        ['label' => 'Third Level', 'menuOptions' => ['class' => 'sidenav-third-level'], 'items' => [
                                ['label' => 'Third Level Item'],
                                ['label' => 'Third Level Item'],
                                ['label' => 'Third Level Item'],
                            ]
                        ],
                    ],
                ],
                ['label' => 'Link', 'icon' => 'link'],
            ],
        ]);
        ?>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
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
                    <a class="nav-link" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link small" href="#">View all messages</a>
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
                    <a class="nav-link" href="#">
                        <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="#">
                        <span class="text-danger">
                            <strong>
                                <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" href="#">
                        <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link small" href="#">View all alerts</a>
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
    </div>
</nav>


</div>
</nav-->
