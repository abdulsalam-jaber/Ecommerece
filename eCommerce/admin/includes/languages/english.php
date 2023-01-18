<?php
    function lang($phrase){
        static $lang = array(
            //Dashboard 
            'HOME' => 'Admin',
            'CATEGORIES' => 'Categories',
            'EDIT_PROFILE' => 'Edit_Profile',
            'SETTING' => 'Setting',
            'MEMBERS' => 'Members',
            'ITEMS' => 'Items',
            'LOG_OUT' => 'Log_Out'

        );
        return $lang[$phrase];
    }
?>