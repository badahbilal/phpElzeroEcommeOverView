<?php

    function lang( $phrase) {

        static $lang = array(

          'MESSAGE' => 'Welcome',

          'Admin' => 'Administrator',


            // NavBar
            'DASHBOARD'             =>'DashBoard',
            'HOME_ADMIN'            => 'Home',
            'CATEGORIES'            => 'Categories',
            'ITEMS'                 => 'Items',
            'MEMBRES'               => 'Members',
            'STATISTICS'            => 'Statistics',
            'EDIT_PROFILE'          => 'Edit profile',
            'SETTINGS'              => 'Settings',
            'LOGOUT'                => 'Logout',

        );

        return $lang[$phrase];
    }



?>