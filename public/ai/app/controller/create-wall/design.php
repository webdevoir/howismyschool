<?php

if( $login->is_user_logged_in() ) {
    $is_logout = 'show';
}
else {
    $is_logout = 'hide';
}
require_once('./view/create-wall/design.php');

?>