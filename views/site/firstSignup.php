<?php
/**
 * Author: Martinus D. Setiono
 * Date: 23/07/2015
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-firstsignup">
    <h1>Administrator Signup</h1>

    <p>Halaman ini dikhususkan untuk registrasi pengguna dengan hak akses penuh atau
        untuk suatu hal dimana pengguna dengan hak akses <strong>Administrator</strong>
        tidak dapat ditemukan.</p>

    <p>Silahkan mengisi data yang diperlukan untuk memulai registrasi :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-firstsignup']); ?>
            <?= $form->field($model, 'username')->label('Auth ID') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
