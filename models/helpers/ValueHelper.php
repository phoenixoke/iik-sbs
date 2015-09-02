<?php
/**
 * Author: Martinus D. Setiono
 * Date: 08/07/2015
 */

namespace app\models\helpers;

use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use app\models\Role;

class ValueHelpers
{
    /**
     * @param string $role_id
     * @param string $role_name
     * @return mixed
     * @throws ErrorException
     */
    public static function getRoleValue($role_id = '', $role_name = '')
    {
        if (empty($role_id) && empty($role_name)) {
            throw new ErrorException('Empty Role Parameter');
        } else {
            if ($role_id && $role_name) {
                throw new ErrorException('Error Role Parameter');
            } else {
                if ($role_id) {
                    return ArrayHelper::getValue(Role::find()->where(['id' => $role_id])->one(),'role_value');
                } else {
                    return ArrayHelper::getValue(Role::find()->where(['role_name' => $role_name])->one(),'role_value');
                }
            }
        }
    }

    /**
     * Return the value of a role name handed in as string
     * example : 'Admin'
     *
     * @param mixed $role_name
     */
    /*
    public static function getRoleValue($role_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT role_value FROM role WHERE role_name=:role_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":role_name", $role_name);
        $result = $command->queryOne();

        return $result['role_value'];
    }
    */

    /**
     * return the value of a status name handed in as string
     * example : 'Active'
     * @param mixed $status_name
     */
    public static function getStatusValue($status_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT status_value FROM status WHERE status_name=:status_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":status_name", $status_name);
        $result = $command->queryOne();

        return $result['status_value'];
    }
}