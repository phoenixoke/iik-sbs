<?php
/**
 * Author: Martinus D. Setiono
 * Date: 24/07/2015
 */
use yii\helpers\Url;
use kartik\sidenav\SideNav;
use app\models\helpers\RecordHelper;

$user = Yii::$app->user->identity;

if ($user) {

    echo SideNav::widget([
        'type' => SideNav::TYPE_DEFAULT,
        'heading' => 'Options',
        'items' => [
            [
                'url' => Url::to(['site/index']),
                'label' => 'Home',
                'icon' => 'home'
            ],
            [
                'label' => 'Informasi Tagihan',
                'icon' => 'book',
                'items' => [
                    ['label' => 'Pribadi', 'icon' => 'search', 'url' => Url::to('site/tagihan-pribadi')],
                    ['label' => 'Tiap Siswa', 'icon' => 'search', 'url' => Url::to(['site/tagihan-per-siswa'])],
                    ['label' => 'Tiap Prodi', 'icon' => 'search', 'url' => Url::to(['site/tagihan-per-prodi'])],
                ]
            ],
            [
                'label' => 'Informasi Pembayaran',
                'icon' => 'book',
                'items' => [
                    ['label' => 'Pribadi', 'icon' => 'search', 'url' => Url::to('site/pembayaran-pribadi')],
                    //['label' => 'Tiap Siswa', 'icon' => 'search', 'url' => Url::to(['site/pembayaran-per-siswa'])],
                    //['label' => 'Tiap Prodi', 'icon' => 'search', 'url' => Url::to(['site/pembayaran-per-prodi'])],
                ]
            ],
            [
                'label' => 'Management',
                'icon' => 'cog',
                'items' => [
                    [
                        'label' => 'User Management',
                        'icon' => 'user',
                        'items' => [
                            ['label' => 'Master User', 'icon' => 'search', 'url' => Url::to(['user/index'])],
                            ['label' => 'Admin Profile', 'icon' => 'search', 'url' => Url::to(['user/index'])],
                            ['label' => 'Staff Profile', 'icon' => 'search', 'url' => Url::to(['user/index'])],
                            ['label' => 'Siswa Profile', 'icon' => 'search', 'url' => Url::to(['user/index'])],
                        ]
                    ],
                ]
            ],
            [
                'label' => 'Help',
                'icon' => 'question-sign',
                'items' => [
                    ['label' => 'About', 'icon' => 'info-sign', 'url' => Url::to(['site/about'])],
                    ['label' => 'Contact', 'icon' => 'phone', 'url' => Url::to(['site/contact'])],
                ],
            ],
        ],
    ]);
}


?>