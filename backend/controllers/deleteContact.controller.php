<?php
include "./functions/db.php";
try{    
    $data = json_decode(file_get_contents("php://input"), true);        
    if(isset($data["id"])){        
        $id = $data["id"];
        $statement = $con->prepare("DELETE FROM contacts WHERE id=:id");
        $statement->execute(array(':id' => $id));
    }
}catch(PDOException $e){
    http_response_code(404);
    json_encode(["message"=>"We can't do this operation, Something wrong in the server","err"=>$e->getMessage()]);
}