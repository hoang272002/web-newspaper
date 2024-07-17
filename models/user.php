<?php
class userModel{
    function __construct() {
        $this->user_id = "";
        $this->username = "";
        $this->email = "";
        $this->password = "";
        $this->status = "";
        $this->user_type  = "";
    }

    public static function checkUser($name, $pass) {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM users where username = '$name' and password = '$pass'" ;
        $result = $mysqli->query($query);
        $DSuser = array();
        

        if ($result){
            foreach ($result as $row){
                $userInfor = new userModel();
                $userInfor->user_id = $row["user_id"];
                $userInfor->username = $row["username"];
                $userInfor->email = $row["email"];
                $userInfor->password = $row["password"];
                $userInfor->status = $row["status"];
                $userInfor->user_type = $row["user_type"];
                $DSuser[] = $userInfor;
            }
            }
           
       

        $mysqli->close();
        return $DSuser;
    }
}
    ?>