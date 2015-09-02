<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="body-content">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/images/iik_girl_study.jpg" alt="iik_girl_study">
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <!--
                        <h3><?= Html::encode("Student Billing System (SBS)") ?></h3>
                        <p>SBS adalah sistem informasi tagihan dan pembayaran siswa/mahasiswa aktif yang sedang menjalani studi di SMK Kesehatan Bhakti Wiyata dan Institut Ilmu Kesehatan (IIK).<br><br>Anda akan membutuhkan No. Virtual Account dan tanggal lahir untuk dapat mengakses Student Billing System (SBS) ini.</p>
                        -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                        ]); ?>
                        <?= $form->field($model, 'username',[
                            'inputOptions' => ['autocomplete' => 'off', 'placeholder' => 'Virtual Account / ID']
                        ])->label('Auth ID') ?>
                        <?= $form->field($model, 'password',[
                            'inputOptions' => [ 'placeholder' => 'Tanggal Lahir / Auth Key']
                        ])->passwordInput()->label('Auth Key') ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
