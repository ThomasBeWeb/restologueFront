<?php
//Si session, affichage du module insertion de message sinon message demandant connexion

if($_SESSION){
?> 
<div class="row">
    <form class="form" action="http://restologue/?page=livredor" role="form" method="post">
        <div class="input-group mb-3 col-auto">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Message</span>
            </div>
            <input type="text" class="form-control text-center" id="message" name="message" aria-label="pwd"
                aria-describedby="basic-addon1" style="max-width: 200px">
        </div>
    
        <button type="submit" class="btn btn-outline-success">Publier</button>
    </form>
    </div>
    <br>
<?php
}else{
?>
    <h4>Vous devez être connecté pour accéder au livre d'or</h4>
<?php
}

if(isset($_POST['message'])){ //Si message envoye
    
    //Recup des messages precedents
    $json_source = file_get_contents('./sources/messages.json');
    $listeMessages = json_decode($json_source, true);

    //Recup des infos
    $dateMessage = date("d/m/Y H:i");
    $user = $_SESSION['username'];
    $message = $_POST['message'];

    //Determiner le nouvel ID
    $newID = end($listeMessages)['id'] + 1;

    //Creation du post au format tableau
    $postTableau = ['id' => $newID, 'user' => $user, 'date' => $dateMessage, 'message' => $message];

    //Integration au tableau en cours
    array_push($listeMessages, $postTableau);

    //Conversion au format JSON
    $listePostsJson = json_encode($listeMessages, JSON_PRETTY_PRINT); //This parameter will format our JSON object and store it in json file
    
    //Recup du fichier d'origine
    $file = "./sources/messages.json";
    
    //Ecrire la nouvelle liste dans le fichier messages.json
    file_put_contents($file, $listePostsJson);

};

//Affichage de la liste des messages

$json_source = file_get_contents('./sources/messages.json');
$listeMessages = json_decode($json_source, true);
?>

<!-- Affichage des messages-->
<div class="d-flex flex-column-reverse">
<?php
foreach($listeMessages as $object){
    ?>
        <div class="p-2">
            <h4><?= $object['user']; ?> </h4>
            <h6><i><?= $object['date']; ?></i></h6>
            <h5><?= $object['message']; ?> </h5>
        </div>
    <?php
};
?>
</div>
