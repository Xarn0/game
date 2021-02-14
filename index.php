<?php
require_once 'sys/connect.php';

$set['title']='Заголовок';

// include_once 'sys/functions.php';
include_once 'sys/head.php';

if(isset($ku))
{
include_once 'pages/shop.php';
}
if(!isset($ku))
{
include_once 'pages/no_auth.php';
}

