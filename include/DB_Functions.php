<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }



/**
     * Adding new img to mysql database
     * returns user details
     */

    public function storeImage($caption,$image,$name,$email,$phone,$lat,$longitude) {
       
        $result = mysql_query("INSERT INTO imgupload(caption,image,name,email,phone,lat,longitude)VALUES('$caption', '$image','$name','$email','$phone','$lat','$longitude')");
        // check for successful store
        if ($result) {
            // get user details 
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM imgupload WHERE id = $id");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
}
?>
