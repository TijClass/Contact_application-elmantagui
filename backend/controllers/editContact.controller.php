<?php
include "./functions/db.php";
try{
    $data = json_decode(file_get_contents("php://input"), true); 
    if(isset($data["id"]) && isset($data["firstName"]) && isset($data["lastName"]) && isset($data["email"]) && isset($data["phone"]) && isset($data["adress"]) && isset($data["groupe"])){
        $id = $data["id"];
        $firstName = $data["firstName"];
        $lastName = $data["lastName"];
        $email = $data["email"];        
        $phone = $data["phone"];
        $adress = $data["adress"];
        $groupe = $data["groupe"];
        $statement = $con->prepare("UPDATE `contact_application`.`contacts` 
        SET first_name=:firstName ,last_name=:lastName ,email=:email ,phone=:phone ,adress1=:adress ,group=:groupe 
        WHERE  id=:id");
        $statement->bindParam(":id",$id,PDO::PARAM_INT);
        $statement->bindParam(":firstName",$firstName,PDO::PARAM_STR);
        $statement->bindParam(":lastName",$lastName,PDO::PARAM_STR);
        $statement->bindParam(":email",$email,PDO::PARAM_STR);
        $statement->bindParam(":phone",$phone,PDO::PARAM_STR);
        $statement->bindParam(":adress",$adress,PDO::PARAM_STR);
        $statement->bindParam(":groupe",$groupe,PDO::PARAM_STR);        
        $statement->execute();
    }
}catch(PDOException $e){
    http_response_code(404);
    json_encode(["message"=>"We can't do this operation, Something wrong in the server","err"=>$e->getMessage()]);
}