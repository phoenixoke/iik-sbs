<?php
/**
 * Author: Martinus D. Setiono
 * Date: 23/07/2015
 */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Role;
use yii\bootstrap\ActiveForm;

?>

<div class="admin-signup">
    <h1>Create User</h1>

    <p>Silahkan mengisi data yang diperlukan untuk memulai registrasi User :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-firstsignup']); ?>
            <?= $form->field($model, 'username')->label('Auth ID') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
            <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::find()->all(),'id','role_name'))->label('Role') ?>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
