<?php
session_start();

include "./template/header.html";
include "./template/navigation.php";

//Affichage content en fonction du GET

if($_GET){
    include "./contents/".$_GET['page'].".php";
}else{
    include "./template/default.html";  //Page Home
}
include "./template/footer.html";
?>		