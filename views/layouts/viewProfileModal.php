<?php
/**
 * Author: Martinus D. Setiono
 * Date: 27/07/2015
 */
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Html;
use app\models\helpers\RecordHelper;

Modal::begin([
    'id' => 'viewProfileModal',
    'header' => '<h2>User Information</h2>',
]);

echo DetailView::widget([
    'model' => $user,
    'attributes' => [
        [
            'label' => 'Username',
            'value' => $user->username,
        ],
        [
            'label' => 'Email',
            'value' => $user->email,
        ],
        [
            'label' => 'Role',
            'value' => ucfirst(RecordHelper::getRoleNameFrom($user->role_id)),
        ],
        [
            'label' => 'Status',
            'value' => ucfirst(RecordHelper::getStatusNameFrom($user->status_id)),
        ],
        'created_at:datetime',
    ],
]);
?>


<?php if(!RecordHelper::getSecondaryUserIdFromPrimaryUserId($user->owner->id)) { ?>
    <p class="text-center">You have no extra Profile Information, <em>Create one now</em>.</p>


    <?php /*$this->render('@app/views/admin/_form', [
        'model' => $model,
    ]); */?>

    <?php
    $model = \app\models\User::findOne(2);
    var_dump($model);

    ?>


<?php } ?>

<?php Modal::end(); ?>