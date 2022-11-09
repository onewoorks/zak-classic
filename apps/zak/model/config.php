<?php 
class Connection {

    public function execute($query){
        $user   = "x";
        $pass   = "x";
        $host   = 'x';
        $dbse   = "x";
        $conn   = mysqli_connect($host,$user,$pass) or die("connection error");
        mysqli_select_db($conn, $dbse);
        return mysqli_query($conn, $query);
    }
}