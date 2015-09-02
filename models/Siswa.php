<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property integer $id
 * @property string $siswa_name
 * @property integer $prodi_id
 * @property integer $angkatan_id
 * @property integer $status_id
 * @property string $siswa_va
 * @property integer $siswa_old_id
 * @property integer $gelombang_id
 * @property integer $siswa_type_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siswa_name'], 'required'],
            [['prodi_id', 'angkatan_id', 'status_id', 'siswa_old_id', 'gelombang_id', 'siswa_type_id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['siswa_name'], 'string', 'max' => 100],
            [['siswa_va'], 'string', 'max' => 16],
            [['user_id'], 'unique'],
            [['siswa_va'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siswa_name' => 'Siswa Name',
            'prodi_id' => 'Prodi ID',
            'angkatan_id' => 'Angkatan ID',
            'status_id' => 'Status ID',
            'siswa_va' => 'Siswa Va',
            'siswa_old_id' => 'Siswa Old ID',
            'gelombang_id' => 'Gelombang ID',
            'siswa_type_id' => 'Siswa Type ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
