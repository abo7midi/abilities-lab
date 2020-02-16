<?php

function lang($phrase){
    static $lang = array(
        // Dashboard Page
        'HOME_ADMIN' => 'Home',
        'CATEGORIES' => 'Categories',
        'STARS'      => 'Stars',
        'MEMBERS'    => 'Members',
        'ABOUT_US'    => 'About Us',
        'STATISTICS' => 'Statistics',
        'LOGS'       => 'Logs',
    );

    return $lang[$phrase];
}
?>