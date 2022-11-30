<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>

<style>

.conteneur { 
            max-width: 1000px; 
            margin: 30px auto; 
            padding: 20px; 
            border: 1px solid;
         }

        header { 
             padding: 100px;
             background-color: crimson;
              color: white;
               text-align: center; 
            }
        form, .affichage { 
            margin: 50px auto;
             width: 35%; 
             padding: 20px;
              border: 1px solid; 
            }

        input { width: 100%;
             height: 35px;
              }

        #valider { color: white; 
            background-color: crimson;
             border: 0; 
            }


</style>

<body>

<header>Formulaire 1</header>
    <div class="conteneur">

    


        <div class="affichage">

            <?php 
            //récuprer le name des input

            echo '<pre>';
            print_r($_POST);
            echo '</pre>';

            


            if( isset($_POST['nom'])  &&  isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['codepostal']) && isset($_POST['sexe']) && isset($_POST['description'])) {
                //echo 'test';
                $nom = trim($_POST['nom']);
                $prenom  = trim($_POST['prenom']);
                $adresse = trim($_POST['adresse']);
                $ville = trim($_POST['ville']);
                $codepostal = trim($_POST['codepostal']);
                $description = trim($_POST['description']);
                $taille_nom = iconv_strlen($nom);
                $taille_prenom = iconv_strlen($prenom);
                $erreur = 'non';

                

                if($taille_nom < 3 || $taille_nom > 10){
                    echo '<p style="color: red;">Attention, votre nom doit avoir entre 6 et 10 caractères inclus</p>';
                    $erreur = 'oui';
                }else{
                    echo '<p style="color: green;">Taille du nom ok !</p>';
                }

                if($taille_prenom < 3 || $taille_prenom > 10){
                    echo '<p style="color: red;">Attention, votre prenom doit avoir entre 6 et 10 caractères inclus</p>';
                    $erreur = 'oui';
                }else{
                    echo '<p style="color: green;">Taille du prenom ok !</p>';
                }

                if($erreur == 'non'){
                    

                    $f = fopen('liste.txt', 'a');

                    fwrite($f, $nom . ' - ' . $prenom . "\n" . $adresse . ' - ' . $ville . "\n". $codepostal . ' - ' . $description);

                    fclose($f);

                    echo '<script>window.location = "exoformulaire.php"</script>';
    
                }
    



                
            }


            if( file_exists('liste.txt') ) {
               
                $contenu_fichier = file('liste.txt');

                echo '<ul>';
    
                foreach($contenu_fichier AS $ligne) {
                    echo "<li>$ligne</li>";
                }
    
                echo '</ul>';
    
    
            }
                
               



            ?>

           

        </div>

        
        <form method="post" action="" enctype="multipart/form-data">
            <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Nom"><br><br>
            <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="prenom"><br><br>
            <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" placeholder="adresse"><br><br>
            <label for="ville">Ville</label>
                <input type="text" name="ville" id="ville" placeholder="Ville"><br><br>
            <label for="code postal">Code Postal</label>
                <input type="text" name="codepostal" id="codepostal" placeholder="75000"><br><br>
            <label for="sexe">Sexe</label>
            <select id="sexe" name="sexe">
                <option selected>Homme</option>
                <option>Femme</option>
            </select><br><br>
            <textarea name="description" id="description" rows="5" placeholder="description"></textarea><br><br>
                <input type="submit" name="envoi" id="envoi" value="Envoi">
        </form>

    </div>

    
</body>
</html>