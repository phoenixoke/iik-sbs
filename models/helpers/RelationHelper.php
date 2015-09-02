<?php
/**
 * Author: Martinus D. Setiono
 * Date: 08/07/2015
 */

namespace app\models\helpers;

use app\models\helpers\RecordHelper;
use app\models\Role;

class RelationHelper
{
    public static function getClassFromRoleId($role_id)
    {
        $roleName = '\\app\\models\\'.ucfirst(RecordHelper::getRoleNameFrom($role_id));
        $calledClass = $roleName;

        return $calledClass;
    }


}