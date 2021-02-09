<?php

function lang( $phrase) {

    static $lang = array(

        'MESSAGE' => 'اهلا',

        'Admin' => 'المدير '
    );

    return $lang[$phrase];
}



?>