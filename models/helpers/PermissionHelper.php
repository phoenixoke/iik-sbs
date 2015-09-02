<?php
/**
 * Author: Martinus D. Setiono
 * Date: 31/07/2015
 */

namespace app\models\helpers;


class PermissionHelper
{
    public static function allowViewContentFromRole($min_role_value, $current_role_id)
    {
        $current_role_value = ValueHelpers::getRoleValue($current_role_id);
        return $current_role_value >= $min_role_value;
    }
}