<?php

function obtainContacts($id){
    include 'db.php';
    try{
        return $conn->query("SELECT id, name, company, phone FROM contacts where id_user=$id");
    }catch(Exception $e){
        echo "Error!", $e->getMessage() . "<br>";
        return false;
    }
}

//obtain single one

function obtainContact($id){
    include 'db.php';
    try{
        return $conn->query("SELECT id, name, company, phone FROM contacts WHERE id = $id");
    }catch(Exception $e){
        echo "Error!", $e->getMessage() . "<br>";
        return false;
    }

}

function login($username,$password ){
    include 'db.php';
    try{
         $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
       
        return $conn->query("select *from login where ((username = '$username' )or(email = '$username' ))  and password = '$password'");
    }catch(Exception $e){
        echo "Error!", $e->getMessage() . "<br>";
        return false;
    }

}
function insert($username,$password,$email){
    try{
                include 'db.php';
                $statement = $conn->prepare("INSERT INTO `login` (`id`, `username`, `password`, `email`) VALUES (NULL, ?,?,?);");
                $statement->bind_param("sss", $username,$password,$email); //s for each string inserted
                $statement->execute();
                return ($statement->affected_rows == 1);
                $statement->close();
                $conn->close();
        }catch(Exception $e){
               
               return false;

        }
}