
<?php
class Conf {
  static private $databases = array(
    // Hostname localhost
    'hostname' => 'localhost',

    //database name
    'database' => 'fakeap',

    //'root' account
    'login' => 'fakeap',

    //pwd created during setup
    'password' => 'fakeap'
  );

  static private $debug = True;
  static public function getDebug(){
    return self::$debug;
  }

  static public function getLogin() {
    //in PHP, indices of arrays car be strings (or integers)
    return self::$databases['login'];
  }
  static public function getDatabase(){
        return self::$databases['database'];
  }
  static public function getHostname(){
        return self::$databases['hostname'];
  }
  static public function getPassword(){
        return self::$databases['password'];
  }

}
?>


