<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\jui;
use app\models\Status;
use app\models\Role;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-condensed table-hover'],
        'columns' => [
            ['class' => \yii\grid\SerialColumn::className()],
            [
                'attribute' => 'username',
                'label' => 'Username',

            ],
            'email:email',
            [
                'attribute' => 'roleName',
                'label' => 'Role',
                'filterOptions' => [
                    'style' => 'width:120px',
                ],
                'filter' => Html::activeDropDownList($searchModel, 'roleName', ArrayHelper::map(Role::find()->asArray()->all(),'role_name','role_name'), [
                    'class'=>'form-control','prompt' => '- Select -'
                ]),
            ],
            [
                'attribute' => 'statusName',
                'label' => 'Status',
                'filterOptions' => [
                    'style' => 'width:120px',
                ],
                'filter' => Html::activeDropDownList($searchModel, 'statusName', ArrayHelper::map(Status::find()->asArray()->all(),'status_name','status_name'), [
                    'class'=>'form-control','prompt' => '- Select -'
                ]),
            ],
            [
                'attribute' => 'createdDate',
                'label' => 'Created Date',
                'format' => 'raw',
                'filterOptions' => [
                    'style' => 'width:200px',
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'createdDate',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => false,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ],
            //'updated_at',
            [
                'attribute' => 'creatorName',
                'label' => 'Creator',
            ],
            //'updated_by',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'style' => 'width:70px'

                ],
                'contentOptions' => [
                    'class' => 'text-center',
                ],
                'headerOptions' => [
                    'class' => 'text-center',
                ]
            ],
        ],
    ]); ?>
</div>
