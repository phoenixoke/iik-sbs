<?php
/**
 * Author: Martinus D. Setiono
 * Date: 31/07/2015
 */

namespace app\models;

use Yii;
use yii\base\Model;

class UserUpdateForm extends Model
{
    /**
     * Custom Class with separated loading for User Information
     *
     */


    public $id;
    public $username;
    public $email;
    public $role_id;
    public $status_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['role_id','status_id'], 'integer'],
        ];
    }

    /**
     * Update user up.
     * $id Get User Id from Controller
     * @return User|null the saved model or null if saving fails
     */
    public function update($id)
    {
        if ($this->validate()) {
            $user = User::findOne($id);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->role_id = $this->role_id;
            $user->status_id = $this->status_id;
            $user->updated_by = Yii::$app->user->identity->getId();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            exit();
            if ($user->update($id)) {
                return $user;
            }
        }

        return null;
    }
}