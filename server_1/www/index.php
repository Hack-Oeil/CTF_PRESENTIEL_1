<?php
session_start();
// Si le fichier __DIR__.'/src/controllers/connexion.php' n'existe pas, c'est que le challenge n'est pas encore configuré)
if(!file_exists(__DIR__.'/src/controllers/connexion.php')) { header("location:init.php"); }

$template = 'index';
$uriWithoutParams = strstr($_SERVER['REQUEST_URI'], '?', true) ?:$_SERVER['REQUEST_URI'];

if(isset($uriWithoutParams) && $uriWithoutParams != '/index.php' && trim($uriWithoutParams,'/') != '') {
    $route = str_replace(['/','index.php'], '', $uriWithoutParams);
    
    $controller = __DIR__.'/src/controllers/'.$route.'.php';
    if(file_exists($controller)) {
        require __DIR__.'/app/database.php';
        require $controller;
    }
    
    $view = __DIR__.'/templates/'.$route.'.phtml';
    if(file_exists($view)) {
        $template = $route;
    } else {
        $template = 'error_404';
    }
}

require __DIR__.'/templates/layout.phtml';