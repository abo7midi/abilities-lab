<?php

function lang($phrase){
    static $lang = array(
        'MESSAGE' => 'أهلا',
        'ADMIN' => 'بلقيس'
    );

    return $lang[$phrase];
}
?>