<?php
global $form, $error, $message;
$form = 1;
if(sizeof($_POST) > 0) {
    // guillaume est admin
    if(isset($_POST['email'])) {
        // pour des raisons de sécurité guillaume doit entrer 2 mots de passe
        if(SHA1($_POST['email']) == '{{ EMAIL }}' && SHA1(MD5($_POST['password'])) === '{{ PASSWORD }}') {
            $form = 2;  
        } else  {
            $error = 'Erreur d\'identification';
        }
    }
    elseif(isset($_POST['admin_password'])) {
        $passAdmin = substr(SHA1(date('Y-m-d').'@cces_adm1n-secret-salt-ultra-super-securise'), 0, 10);
        // pour des raisons de sécurité guillaume doit entrer 2 mots de passe
        if($_POST['admin_password'] === $passAdmin) {
            $message = 'Bien joué voici le Flag : <strong>{{ FLAG }}<strong>';
            $form = 0;
        } 
    }
}