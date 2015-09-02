<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\jui;

use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\icons\Icon;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Icon::map($this, Icon::FA);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

    <div class="wrap">
        <?php
            NavBar::begin([
                //'brandLabel' => 'Student Billing System',
                'brandLabel' => '
                    <img src= "'.Yii::getAlias('@web').'/images/iik_bw_longbanner.png" class="img-responsive visible-sm-inline visible-md-inline visible-lg-inline">
                    &nbsp;&nbsp;<img src= "'.Yii::getAlias('@web').'/images/smk_bw_longbanner.png" class="img-responsive visible-sm-inline visible-md-inline visible-lg-inline">
                    <img src= "'.Yii::getAlias('@web').'/images/iik_small_logo.png" class="img-responsive visible-xs-inline">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'items' => [
                    [
                        'label' => 'Login',
                        'url' => ['site/index'],
                        'visible' => Yii::$app->user->isGuest
                    ],
                    Yii::$app->user->isGuest ?
                        [
                            'label' => 'Contact',
                            'url' => ['/site/contact']
                        ] :
                        [
                            'label' => Icon::show('user', [], Icon::FA).'<strong>' . Yii::$app->user->identity->username . '</strong>',
                            //'url' => ['/site/viewprofilemodal']
                            'items' => [
                                [
                                    'label' => '<li><a href="#" data-toggle="modal" data-target="#viewProfileModal">Profile</a></li>'
                                ],
                                '<li class="divider"></li>',
                                [
                                    'label' => 'Logout',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ],
                            ]
                        ],
                ],
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
            ]);
            NavBar::end();

        ?>

        <div style="padding-top: 70px" class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <div class="row">

                <div class="col-md-2">
                    <?= $sidenav = !Yii::$app->user->isGuest ? $this->render('@app/views/layouts/sidenav.php') : '' ?>;
                </div>

                <?php
                $content = Yii::$app->user->isGuest ?
                    '<div class="col-md-8">'.$content.'</div><div class="col-md-2"></div>' :
                    '<div class="col-md-10">'.$content.'</div>' ;

                echo $content;
                ?>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Bhakti Wiyata <?= date('Y') ?></p>
        </div>
    </footer>

    <?= $sidenav = ($user = Yii::$app->user->identity) ? $this->render('@app/views/layouts/viewProfileModal.php',['user' => $user]) : '' ?>;

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
