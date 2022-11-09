<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php


class userFacade extends User {
    
    var $listUserId = 2;
    
    function findAll() {
        
        $a = $this->database->query("SELECT * FROM tbl_user;");
        $a = $this->database->result;
        while($c=mysqli_fetch_array($a)){
            $resultList[] = $c[0];
        }
        foreach ($resultList as $rl){
            echo  $rl."<br />";
        }
//        
//        $sql = "SELECT * FROM tbl_user;";
//        $result = $this->database->query($sql);
//        $result = $this->database->result;
//        $row = mysqli_fetch_object($result);
//        $resultList .= $resultList . "-".$row->usr_id;
//       // $this->usr_id = $row->usr_id;
//        //$this->usr_fname = $row->usr_fname;
//        //$this->usr_name = $row->usr_name;
//        $this->usr_id = $row->usr_id;
//        //$this->usr_login = $row->usr_login;
//        $this->listUserId = $resultList;
    }
    
    function getSingleObject($colName){
        $a = $this->database->query("SELECT * FROM tbl_user WHERE usr_id=1;");
        $a = $this->database->result;
        $c = mysqli_fetch_object($a);
        
        $array = (array)$c;
        $value = $array[$colName];
        print $value;
//        foreach($resultObject as $ro){
//            echo 
//        }
        
    }
}

?>
