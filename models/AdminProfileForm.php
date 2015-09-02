<?php
/**
 * Author: Martinus D. Setiono
 * Date: 28/07/2015
 */

use app\models\Admin;

class AdminProfileForm extends Admin
{
    public $adminName;

    public function rules()
    {
        return [
            ['admin_name','string'],
            ['admin_name','required'],
        ];
    }

    public function signup()
    {
        if($this->validate()) {
            $adminUser = new Admin();
            $adminUser->user_id = $this->id;
            $adminUser->admin_name = $this->admin_name;

            $adminUser->created_by = 0;
        }
    }
}