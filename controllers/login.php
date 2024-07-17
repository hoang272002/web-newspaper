<?php
class loginController
{
    
    public function index()
    {
        require("views/login.phtml");
    }

    public function checkLogin()
    {
        
        if (isset($_POST["btnLogin"]))
        {
            $userInfor = userModel::checkUser($_POST["username"], $_POST["password"]);
            
            if(count($userInfor) > 0){
                session_start();
                $_SESSION['user'] = $userInfor[0];
                header("Location: index.php");
                exit;
            }
            else{
                $message = "Username or password is incorrect !!!";
                require("views/login.phtml");
         }
         
        }
    }

    public function logout() {

        session_start();
      
    
        session_destroy();
      
        header("Location: index.php");
        exit;
      }
}
?>