<?php

 session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["ID"]) ) {
        header("location: login.php");
        exit;
    }
 


    if(empty($_POST)){

        if($_GET['action'] == 'delete'){
    
            require_once('../functions/db.php');
        
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            try{
                $statement = $conn->prepare("DELETE FROM contacts WHERE id = ?");
                $statement->bind_param("i", $id);   
                $statement->execute();
               if($statement->affected_rows == 1){
                $response = array(
                    'response' => 'correct'
                );
               }
                $statement->close();
                $conn->close();
            }catch(Exception $e){
                $response = array(
                 'error'=> $e->getMessage()
                );
            }
            echo json_encode($response);
            exit;
        }
    }

    if(empty($_GET)){

        if($_POST['action'] == 'create'){
            // Create new registry
            require_once('../functions/db.php');
        
            //Prepare statement to avoid SQL inyections.
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        
            try{
                $statement = $conn->prepare("INSERT INTO contacts (name, company, phone,id_user) VALUES (?, ?, ?,?)");
                $statement->bind_param("ssss", $name, $company, $phone,$_SESSION['ID']); //s for each string inserted
                $statement->execute();
                if($statement->affected_rows == 1){
                $response = array(
                    'response' => 'correct',
                    'data'=> array(
                        'name' => $name,
                        'company'=> $company,
                        'phone'=> $phone,
                        'inserted_id' => $statement->insert_id
                    )
                 ); 
                }
                $statement->close();
                $conn->close();
            }catch(Exception $e){
                $response = array(
                    'error' => $e->getMessage()
                );
            }
             echo json_encode($response);
             exit;
        }
    
        if($_POST['action'] == 'update'){
            
            // Create new registry
            require_once('../functions/db.php');

            //Prepare statement to avoid SQL inyections.
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

            try{

                $statement = $conn->prepare("UPDATE contacts SET name = ?, company = ?, phone = ? WHERE id = ?");
                $statement->bind_param("sssi", $name, $company, $phone, $id);
                $statement->execute();
                if($statement->affected_rows == 1){
                    $response = array(
                        'response' => 'correct'
                    );
                }else{
                    $response = array(
                        'response' => 'error'
                    );
                }
                $statement->close();
                $conn->close();
            }catch(Exception $e){
                $response = array(
                    'error' => $e->getMessage()
                );
            }
                echo json_encode($response);
            exit;
        }
    
    }

    


   



