<?php

function ms($m) {
    echo "-----\n";
    echo'<pre>';
    var_dump($m);
    echo '</pre>';
    echo "-----\n";
}


ini_set('display_errors', 1);
require_once 'application/bootstrap.php';