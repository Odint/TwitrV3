<?php
session_start();
define('APP_PATH', __DIR__);
include (APP_PATH.'/conf/_conf.php');
include (INC_DIR.'/functions.php');
include (INC_DIR.'/header.php');

echo "BUIEBFIZEFBJNEOZFNSS";

if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    //header('refresh:5;'.$_SERVER['PHP_SELF']);
}

//Récupère la page à afficher

if(filter_has_var(INPUT_GET, 'page')){
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    
}

if(filter_has_var(INPUT_POST, 'login')){
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $_SESSION['idUser'] = getUserID($login);
}

if(!empty($error)) { ?>
    <div class="error"><?php echo $error;?></div>  
    
<?php 
    }


//Affiche la page demandée

include INC_DIR.DIRECTORY_SEPARATOR.$page.'.php';


$oPDO = NULL;

include(INC_DIR.'/footer.php');