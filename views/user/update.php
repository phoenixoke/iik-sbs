<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = 'Update User: ' . ' ' . $userModel->username;

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <p>
        <?= Html::a('User List', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
