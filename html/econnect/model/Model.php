<?php
    
require_once (File::build_path(array('config','Conf.php')));
    
class Model {
  
  public static $pdo;
  
  

  public static function Init() {
    
      $hostname = Conf::getHostname();
      $login = Conf::getLogin();
      $database_name = Conf::getDatabase();
      $password = Conf::getPassword();
      
      try{
        
        // Connexion to the data base          
        // The last argument is for
        // UTF-8
        self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
        // Error display mode and throwing exeptions in case of errors
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      }catch(PDOException $e) {
        
        if (Conf::getDebug()) {
          
          echo $e->getMessage(); // Error message display
        
        } else {
        
          echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        
        }
                  
        die();
      }
            
  }
        

  //Select all lines in a table of the DB
  public static function selectAll() {
    
      $table_name = "fakeap" . static::$object;
      $class_name = 'Model' . ucfirst(static::$object);
      $rep = Model::$pdo->query("SELECT * FROM $table_name");
      $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab_obj = $rep->fetchAll();
     
      return $tab_obj;
  }
        

        
  //Save an object into a table in the DB 
  public static function save($data) {
     
    $table_name = static::$object;
    $primary_key = static::$primary;
    $attributs = "";
    $variables = "";
    $values = array();
            
    foreach ($data as $cle => $valeur) {
      
      $lastkey = end($data);
      
      if (strcmp($data[''.$cle.''], $lastkey) == 0) {
        
        $attributs = $attributs."".$cle."";
        $variables = $variables.":".$cle."";
        $new_value = array($cle => $valeur,);
        $values = array_merge($values, $new_value);
        
      }else{

        $attributs = $attributs."".$cle.", ";
        $variables = $variables.":".$cle.", ";
        $new_value = array($cle => $valeur,);
        $values = array_merge($values, $new_value);
      }
    }
            
    $sql = "INSERT INTO $table_name ($attributs) VALUES ($variables)";
            
    // Préparation de la requête
    try {
      
      $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL  
      $req_prep->execute($values);
    
    }
    catch(PDOException $e) {
                
      if (Conf::getDebug()) {
        
        echo "erreur connexion";
  
      } 
      die();
    }
  }
}
    

Model::Init();
?>