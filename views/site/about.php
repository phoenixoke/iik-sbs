<?php
/**
 * Author: Martinus D. Setiono
 * Date: 24/07/2015
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><strong>SBS</strong> atau yang merupakan singkatan dari <strong>Student Billing System</strong>
        adalah sistem informasi tagihan dan pembayaran siswa/mahasiswa aktif yang sedang menjalani studi
        di SMK Kesehatan Bhakti Wiyata dan Institut Ilmu Kesehatan (IIK)</p>

    <p>Current Version : <?= Yii::$app->params['appVersion'] ?></p>
</div>
