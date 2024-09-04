<?php
use app\models\User;
use yii\helpers\Html;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.iansoftltd.com" class="brand-link">
        <img src="<?= $assetDir ?>/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         
        <span class="brand-text font-weight-light">IanSoft</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="#" class="d-block">
                        <?= Html::encode(Yii::$app->user->identity->User::getDisplayName()) ?>
                    </a>
                <?php else: ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="d-block">
                        Guest
                    </a>
                <?php endif; ?>
            </div>
        </div>


        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    //     [
                    //         'label' => 'Starter Pages',
                    //         'icon' => 'tachometer-alt',
                    //         'badge' => '<span class="right badge badge-info">2</span>',
                    //         'items' => [
                    //             ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                    //             ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                    //         ]
                    //     ],
                    //     ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    //     ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    //     ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    //     ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    //     ['label' => 'Level1'],
                    //     [
                    //         'label' => 'Level1',
                    //         'items' => [
                    //             ['label' => 'Level2', 'iconStyle' => 'far'],
                    //             [
                    //                 'label' => 'Level2',
                    //                 'iconStyle' => 'far',
                    //                 'items' => [
                    //                     ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                     ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                     ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                    //                 ]
                    //             ],
                    //             ['label' => 'Level2', 'iconStyle' => 'far']
                    //         ]
                    //     ],
                    //     ['label' => 'Level1'],
                    //     ['label' => 'LABELS', 'header' => true],
                    //     ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    //     ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    //     ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                    ['label' => 'Reports', 'header' => true],
                    [
                        'label' => 'Total Tickets',
                        'icon' => 'ticket-alt',
                        'url' => ['report/total-tickets'],
                        'iconClassAdded' => 'text-primary'
                    ],
                        
                        [
                        'label' => 'Weekly',
                        'icon' => 'calendar-day',
                        'url' => ['report/weekly'],
                        'iconClassAdded' => 'text-info'
                        ],
                        [
                        'label' => 'Monthly',
                        'icon' => 'calendar-week',
                        'url' => ['report/monthly'],
                        'iconClassAdded' => 'text-primary'
                        ],
                        [
                        'label' => 'Quarterly',
                        'icon' => 'calendar-check',
                        'url' => ['report/quarterly'],
                        'iconClassAdded' => 'text-warning'
                        ],
                        [
                        'label' => 'Annually',
                        'icon' => 'calendar-alt',
                        'url' => ['report/annually'],
                        'iconClassAdded' => 'text-success'
                        ],
                        ['label' => '', 'header' => true], // Spacer
                        ],
                        'options' => [
                        'class' => 'nav nav-pills nav-sidebar flex-column',
                        'data-widget' => 'treeview',
                        'role' => 'menu',
                        'data-accordion' => 'false'
                        ],


            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<style>
    /* Custom CSS to ensure sidebar extends to the bottom */
    .main-sidebar {
        min-height: 100vh;
        position: fixed;

    }

    /* Adjust content margin when sidebar is collapsed */
    body:not(.sidebar-collapse) .content-wrapper {
        margin-left: 250px;
    }

    body.sidebar-collapse .content-wrapper {
        margin-left: 4.6rem;
    }

    /* Hide text when sidebar is collapsed */
    .sidebar-collapse .nav-sidebar .nav-link p {
        display: none;
    }

    /* Increase icon size when sidebar is collapsed */
    .sidebar-collapse .nav-sidebar .nav-link i {
        font-size: 1.25rem;
        margin-right: 0;
        text-align: center;
        width: 100%;
    }

    /* Add more space between menu items */
    .nav-sidebar .nav-item {
        margin-bottom: 1rem;
    }

    /* Style for the spacer items */
    .nav-sidebar .nav-header:empty {
        height: 2rem;
    }
</style>


<script>
    $(document).ready(function () {
        // Toggle sidebar collapse
        $('[data-widget="pushmenu"]').on('click', function () {
            $('body').toggleClass('sidebar-collapse');
            $('body').toggleClass('sidebar-open');
        });

        // Ensure sidebar reaches the bottom
        function adjustSidebar() {
            var windowHeight = $(window).height();
            var sidebarHeight = $('.main-sidebar').height();
            if (sidebarHeight < windowHeight) {
                $('.main-sidebar').css('min-height', windowHeight);
            }
        }

        // Run on page load and window resize
        adjustSidebar();
        $(window).resize(adjustSidebar);
    });
</script>

