<?php

/** @var yii\web\View $this */
/** @var string $content */


use hail812\adminlte3\assets\AdminLteAsset;
use hail812\adminlte3\assets\FontAwesomeAsset;
use yii\helpers\Html;

FontAwesomeAsset::register($this);
AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

        if ($controller == 'ticket' && $action == 'index') {
            // Render the sidebar for the 'site/index' route
            echo $this->render('sidebar-tickets', ['assetDir' => $assetDir]);
        } 
         elseif ($controller == 'dashboard' && $action == 'index') {
        //     // Render a different sidebar for 'user/profile' route
           echo $this->render('sidebar-dashboards', ['assetDir' => $assetDir]);
        } 
        // else {
        //     // Default sidebar
        //     echo $this->render('sidebar-default', ['assetDir' => $assetDir]);
        // } ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <?= $this->render('control-sidebar') ?>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>