<?php
$form = 1;
if(sizeof($_POST) > 0) {
    // guillaume est admin
    if(isset($_POST['email'])) {
        // pour des raisons de sécurité guillaume doit entrer 2 mots de passe
        if(SHA1($_POST['email']) == '83802b92d1db5a5d45228f587c32d90053f59c36' && SHA1(MD5($_POST['password'])) === '7a9cd24f61303a9f076058f8f44d35bd4e914236') {
            $form = 2;  
        } else  {
            $error = 'Erreur d\'identification';
        }
    }
    elseif(isset($_POST['admin_password'])) {
        $passAdmin = substr(SHA1(date('Y-m-d').'@cces_adm1n-secret-salt-ultra-super-securise'), 0, 10);
        // pour des raisons de sécurité guillaume doit entrer 2 mots de passe
        if($_POST['admin_password'] === $passAdmin) {
            $message = 'Bien joué voici le Flag : <strong>'.SHA1('Le_flag_exercice_presentiel').'<strong>';
            $form = 0;
        } 
    }
}