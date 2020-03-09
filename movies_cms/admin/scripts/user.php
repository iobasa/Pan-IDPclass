<?php

function createUser($fname, $username, $password, $email){
    
    $pdo = Database::getInstance()->getConnection();

    //TODO: finish the below so that it can run a SQL query
    // to create a new user with provided data
    $create_user_query = "INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email, user_ip) VALUES ('$fname', '$username', '$password', '$email', 'no')";
    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_set->execute();

    //TODO: redirect to index.php if create user successfully
    //otherwise, return error message

    // add ! in the if statement to see if the opposite would work
    if(!$create_user_set){
        redirect_to('index.php');
    }else{
    // User doesn't exist
    return 'The user did not go through';
}        

}

function getSingleUser($id){
    $pdo = Database::getInstance()->getConnection();
    //TODO: execute the proper SQL query to fetch the user data whose user_id = $id
    $get_user_query = "SELECT * FROM tbl_user WHERE user_id = :id";  
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id' => $id,
        )
    );

    //TODO: if the execution is successful, return the user data
    // Otherwise, return an error message
    if($get_user_result){
        return $get_user_set;
    }else{
    // User doesn't exist
    return 'There was a problem accessing the user';
}

}

function getAllUsers(){
    $pdo = Database::getInstance()->getConnection();
    //TODO: execute the proper SQL query to fetch the user data whose user_id = $id
    $get_all_user_query = "SELECT * FROM tbl_user";  
    $users = $pdo->query($get_all_user_query); // not usng preapre becasue user has zero impact on the query so you can just run the query instead of prepare
    // $get_all_user_result = $get_all_user_set->execute();

    //TODO: if the execution is successful, return the user data
    // Otherwise, return an error message
    if($users){
        return $users;
    }else{
    // User doesn't exist
    return false;
}

}

function editUser($fname, $username, $password, $email, $id){
    //TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

    //TODO: Run the proper SQL query to update tbl_user with proper values
    $update_user_query = "UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password, user_email = :email WHERE user_id = :id";
            $update_user_set = $pdo->prepare($update_user_query);
            $update_user_result = $update_user_set->execute(
                array(
                    ':id'=>$id,
                    ':fname'=>$fname,
                    ':username'=>$username,
                    ':password'=>$password,
                    ':email'=>$email
                    )
            );

            // for debugging
            // echo $update_user_set->debugDumpParams();
            // exit;

    //TODO: if everything goes well, redirect user to index.php
    // Otherwise, return some error message...
    if($update_user_result){
        redirect_to('index.php');
}else{
    // User doesn't exist
    return 'Could not edit';
}

}

function deleteUser($id){
    
    $pdo = Database::getInstance()->getConnection();
//TODO: finish the function to delete the given user
    $delete_user_query = "DELETE FROM tbl_user WHERE user_id = :id";  
    $delete_user_set = $pdo->prepare($delete_user_query); 
    $delete_user_result = $delete_user_set->execute(
        array(
            ':id'=>$id
        )
    );

         //if everything went through, redirect to admin_deleteuser.php 
    //otherwise return false
    if($delete_user_result && $delete_user_set->rowCount() > 0){
        redirect_to('admin_deleteuser.php');
    }else{
    // User doesn't exist
    return false;
   
}

}