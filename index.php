<?php
session_start();
define('APP_PATH', __DIR__);
include (APP_PATH.'/conf/_conf.php');
include (INC_DIR.'/functions.php');
include (INC_DIR.'/header.php');


if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];

    /*unset($_SESSION['error']);*/ /*pour la version ajax*/
    //header('refresh:5;'.$_SERVER['PHP_SELF']);
}

//Récupère la page à afficher

if(filter_has_var(INPUT_GET, 'page')){
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    ?>  
    <?php 
}

if(filter_has_var(INPUT_POST, 'login')){
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $_SESSION['idUser'] = getUserID($login);
}

if(filter_has_var(INPUT_GET, 'favoris')) {
    $favoris = filter_input(INPUT_GET, 'favoris', FILTER_SANITIZE_NUMBER_INT);
    ?>
    <INPUT TYPE="hidden" id="fav" NAME="fav" VALUE="<?php echo $favoris;?>"> 
      <?php 
}

if(!empty($error)) { ?>
    <div class="error"><?php echo $error;?></div>  
    
<?php 
    }


//Affiche la page demandée

include INC_DIR.DIRECTORY_SEPARATOR.$page.'.php';
/*echo INC_DIR.DIRECTORY_SEPARATOR.$page;*/

?>
<INPUT TYPE="hidden" id="page" NAME="page" VALUE="<?php echo 'includes/'.$page.'2.php';?>"> 
<script>

var page = $("#page").val()
var fav = $("#fav").val()

$.ajax({

  url: page,
  data: {favoris : fav},
  type:"GET",
  success: function (r,x,y) {
        /*$("body").html($(r).find("body").html());*/
        $("body").empty();
        $("body").html(r);
        $('#Ntwit').attr('action','#');
    }
});


</script>



<?php 


$oPDO = NULL;

include(INC_DIR.'/footer.php');