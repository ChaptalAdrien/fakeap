<?php


require_once (File::build_path(array('model','Model.php')));

class ModelUser extends Model {
	  
	  protected static $primary = 'id';
  	  protected static $object = 'user';
  	  
  	  private $id;
  	  private $login;
  	  private $password;
  	  private $socialmedia;

    public function __construct($data = array()) {
	  	
	  	if (!empty($data)) {
		
			if(isset($data["login"])) {
				$this->login = $data["login"];
			}
			
			if(isset($data["password"])) {
				$this->password=$data["password"];
			}

			if(isset($data["socialmedia"])) {
				$this->password=$data["socialmedia"];
			}

			
			if(isset($data["id"])) {
				$this->id=$data["id"];
			}
			
		}
   	}
	

	public function get($nom_attribut) {
	    if (property_exists($this, $nom_attribut))
	        return $this->$nom_attribut;
	    return false;
	}

	public function set($nom_attribut, $valeur) {
	    if (property_exists($this, $nom_attribut))
	        $this->$nom_attribut = $valeur;
	    return false;
	}
	
}

	?>