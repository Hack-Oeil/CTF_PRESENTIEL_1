<?php

/*
require dirname(__DIR__).'/app/database.php';


// change accès admin du jour
$passAdmin = substr(SHA1(date('Y-m-d').'@cces_adm1n-secret-salt-ultra-super-securise'), 0, 10);
$db->prepare('UPDATE access_admin SET password=?');
$query = $db->execute([$passAdmin]);
*/