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