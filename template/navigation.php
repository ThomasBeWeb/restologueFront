<?php
//Barre de navigation

//Dossier racine
$homedir = "http://restologue/";
//$homedir = "http://home:8888/restologuefront/";

//recup de la liste des fichiers du dossier content
$fichiers = scandir("./contents/");

//Creation de la liste de fichiers sous la forme: nom du lien => lien
$listeFichiers = array("home" => $homedir);

foreach($fichiers as $value){
    
      if($value !== "." AND $value !== ".."){     //Verifie si pas "." ou ".."
          
        //recup du nom du lien: nom du fichier sans .php
        $name = explode(".php", $value);
        $nameSansPhp = $name[0];
    
        //Modif livredor pour faire joli
        if($nameSansPhp === "livredor"){
            $nameSansPhp = "Livre d'or";
        }

        //Ajout dans le tableau
        $listeFichiers[$nameSansPhp] = $homedir."?page=".$name[0];
      }
}
?>

<div class="d-flex flex-row">
    <?php
    //Boucle sur la liste des fichiers et affiche
    
    foreach($listeFichiers as $key => $value){
        ?>
            <div class="p-2">
                <a href=<?=$value;?>><?=$key;?></a>
            </div>
         <?php
    }
 ?>
</div>