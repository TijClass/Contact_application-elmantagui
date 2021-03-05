<?php
// function auth($request){
    include "./functions/db.php";
    $requestBody = $request->getBody();
    if(isset($requestBody['email']) && isset($requestBody['password'])){    
        $statement = $con->prepare("select id,password from users where email = :email AND password = :password LIMIT 1");
        $statement->execute(array(':email' => $requestBody['email'],':password'=>$requestBody["password"]));
        $row = $statement->fetch();        
        if(is_array($row)){            
            session_start();
            if($requestBody["rememberme"] == true ){
                setcookie("id",$row["id"], time() + (86400 * 30), "/");
            }else{
                $_SESSION["id"]=$row["id"];
            }  
            header("Location: /");                
        }else{
            header("Location: /login");
        }
        
    }
// }