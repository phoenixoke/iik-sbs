<?php

namespace app\models;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\debug\models\search\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use app\models\Role;
use app\models\Status;
use app\models\helpers\DateHelper;
use app\models\helpers\RecordHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $role_id
 * @property integer $status_id
 * @property string $updated_at
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Role $role
 * @property Status $status
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'status_id', 'created_by', 'updated_by'], 'integer'],
            //['role_id','default','value' => 1],
            //['role_id', 'in', 'range' => array_keys($this->getRoleList())],
            //['status_id','in','range' => array_keys($this->getStatusList())],

            [['updated_at', 'created_at'], 'safe'],

            ['username','filter','filter'=>'trim'],
            ['username','required'],
            [['username'], 'string', 'max' => 45],

            [['auth_key', 'password_hash', 'email'], 'string', 'max' => 255],

            ['email','filter','filter'=>'trim'],
            ['email','email'],
            ['email','unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login ID',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'role_id' => 'Role ID',
            'status_id' => 'Status ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_id' => RecordHelper::getDefaultStatusId()]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);

        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status_id' => RecordHelper::getDefaultStatusId()]);
    }

    /**
     * get role relationship
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * get role name
     */
    public function getRoleName()
    {
        return $this->role ? $this->role->role_name : '-no role-';
    }

    /**
     * get list of roles for dropdown
     */
    public static function getRoleList()
    {
        $droptions = Role::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'role_name');
    }

    /**
     * get status relation
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(),['id' => 'status_id']);
    }

    /**
     * get status name
     */
    public function getStatusName()
    {
        return $this->status ? $this->status->status_name : ' - no status -';
    }

    /**
     * get list of roles for status
     */
    public static function getStatusList()
    {
        $droptions = Status::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'status_id', 'status_name');
    }

    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['user_id' => 'id']);
    }

    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getCreatorName()
    {
        return $this->creator ? $this->creator->username : '- no name -';
    }

    public function getCreatedUsers()
    {
        return $this->hasMany(User::className(),['created_by' => 'id']);
    }

    public function getCreatedDate()
    {
        return $this->created_at ? DateHelper::convertDate($this->created_at, 'date','') : '' ;
    }
}
