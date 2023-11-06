<?php    

    //Définition de la page courante
    if(isset($_GET['page']) AND !empty($_GET['page']))
    {
        $page = trim(strtolower($_GET['page']));
    }else{
        $page = 'Verif';
    }
    
    //Arrau contenant toutes les pages
    $allPages = scandir('Controllers/');

    if(in_array($page.'_Controller.php', $allPages))
    {
        include_once 'Models/'.$page.'_Model.php';
        include_once 'Controllers/'.$page.'_Controller.php';
        include_once 'Vues/'.$page.'_View.php';
    }else{
        echo'Erreur 404';
    }
?>