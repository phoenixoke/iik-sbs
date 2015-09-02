<?php
/**
 * Author: Martinus D. Setiono
 * Date: 23/07/2015
 */

namespace app\models\helpers;

use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use app\models\Role;
use app\models\Status;
use app\models\User;

class RecordHelper
{
    public static function getAdminExistence()
    {
        return count(User::find()
            ->where(['status_id' => RecordHelper::getDefaultStatusId(), 'role_id' => RecordHelper::getAdminRoleId()])
            ->all()) > 0 ? 1 : 0;
    }

    public static function getDefaultStatusId($status_name = "Active")
    {
        return ArrayHelper::getValue(Status::find()->where(['status_name' => $status_name])->one(),'id');
    }

    public static function getAdminRoleId($role_name = 'admin')
    {
        return ArrayHelper::getValue(Role::find()->where(['role_name' => $role_name])->one(),'id');
    }

    public static function getStaffRoleId($role_name = 'staff')
    {
        return ArrayHelper::getValue(Role::find()->where(['role_name' => $role_name])->one(),'id');
    }

    public static function getSiswaRoleId($role_name = 'siswa')
    {
        return ArrayHelper::getValue(Role::find()->where(['role_name' => $role_name])->one(),'id');
    }

    /**
     * @param null $user_id
     * @return integer
     * @throws ErrorException
     */
    public static function getSecondaryUserIdFromPrimaryUserId($user_id = null)
    {
        if (!$user_id && !\Yii::$app->user->identity) {
            throw new ErrorException('Empty User Id Parameter or is not Logged In');
        } else {
            $user_id = !$user_id ? \Yii::$app->user->identity->getId() : $user_id ;

            if (\Yii::$app->user->identity) {
                $role_id = \Yii::$app->user->identity->role_id;
            } else {
                $role_id = User::find()->where(['id' => $user_id])->one();
            }

            $secondaryUserIdModel = RelationHelper::getClassFromRoleId($role_id);
            return $secondaryUserIdModel::find()->where(['user_id' => $user_id])->one();
        }
    }

    /**
     * @param null $status_id
     * @param null $status_value
     * @return mixed
     * @throws ErrorException
     */
    public static function getStatusNameFrom($status_id = null, $status_value = null)
    {
        if (empty($status_id) && empty($status_value)){
            throw new ErrorException('Empty Status Parameter');
        } else {
            if ($status_id && $status_value){
                throw new ErrorException('Error Status Parameter');
            } else {
                if ($status_id) {
                    return ArrayHelper::getValue(Status::find()->where(['id' => $status_id])->one(),'status_name');
                } else {
                    return ArrayHelper::getValue(Status::find()->where(['status_value' => $status_value])->one(),'status_name');
                }
            }
        }
    }

    /**
     * @param null $role_id
     * @param null $role_value
     * @return mixed
     * @throws ErrorException
     */
    public static function getRoleNameFrom($role_id = null, $role_value = null)
    {
        if (empty($role_id) && empty($role_value)){
            throw new ErrorException('Empty Role Parameter');
            //return 'no role';
        } else {
            if ($role_id && $role_value){
                throw new ErrorException('Error Role Parameter');
                //return 'error role parameter';
            } else {
                if($role_id) {
                    return ArrayHelper::getValue(Role::find()->where(['id' => $role_id])->one(),'role_name');
                } else {
                    return ArrayHelper::getValue(Role::find()->where(['role_value' => $role_value])->one(),'role_name');
                }
            }
        }
    }

    public static function getLastAutoIncrementFrom($table_name){
        $connection = \Yii::$app->db;
        $sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.tables WHERE TABLE_SCHEMA =:db_name AND TABLE_NAME =:table_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":db_name", explode('=', \Yii::$app->db->dsn)[2]);
        $command->bindValue(":table_name", $table_name);
        $result = $command->queryOne();

        return $result['AUTO_INCREMENT'];
    }
}