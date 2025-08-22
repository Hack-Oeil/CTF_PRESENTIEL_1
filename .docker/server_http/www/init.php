<?php
// Si le fichier __DIR__.'/src/controllers/connexion.php' existe, interdiction de revenir ici !
if(file_exists(__DIR__.'/src/controllers/connexion.php')) { header("location:index.php"); }

if(sizeof($_POST)) {
    $flag = SHA1(random_bytes(10)); //par défaut
    // Mais si flag personnalisé...
    if(!empty($_POST['flag'])) { $flag = $_POST['flag']; } 
    
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = SHA1($_POST['email']);
        $password = SHA1(MD5($_POST['password']));
        $newContent = file_get_contents(__DIR__.'/src/controllers/connexion_base.php');
        $newContent = str_replace(['{{ EMAIL }}','{{ PASSWORD }}', '{{ FLAG }}'], [$email, $password, $flag], $newContent);

        file_put_contents(__DIR__.'/src/controllers/connexion.php', $newContent);
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration challenge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 580px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        label small {
            font-weight: normal;
        }


        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="text"]:disabled,
        input[type="email"]:disabled,
        input[type="password"]:disabled {
            background-color: #f5f5f5;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Configurez le challenge</h1>
    <form action="init.php" method="post">
        <label for="email">Email (noté sur le post-it) :</label>
        <input type="email" id="email" name="email" value="guillaume@toitoimontoit.fr" required>
        <br><br>

        <label for="password">Mot de passe (noté sur le post-it) :</label>
        <input type="text" id="password" name="password" value="AZErty0123" required><br><br>

        <label for="flag">Flag : <small><i>Double cliquez sur le champ pour pouvoir le modifier</i></small></label>
        <input type="text" id="flag" name="flag" placeholder="Laissez vide pour un flag aléatoire" disabled>
        
        <br><br>
        <div style="width:100%; text-align:center;">
            <button type="submit">Valider</buttton>
        </div>
    </form>

    <script>
        // Fonction pour activer le champ "flag" au double-clic
        document.getElementById("flag").addEventListener("dblclick", function() {
            this.removeAttribute("disabled");
        });
    </script>

</body>
</html>