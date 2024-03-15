<?php

// $db['db_host'] = 'localhost:3306';
// $db['db_user'] = 'aroot';
// $db['db_pass'] = '%1Z4rzw35';
// $db['db_name'] = 'fz-dev_cms';

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connection){
    echo "Db connected successfully";
}else{
    echo "Db failed to connect";
}

?>