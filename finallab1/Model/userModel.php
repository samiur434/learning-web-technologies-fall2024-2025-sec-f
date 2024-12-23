<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
        return $con;
    }

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count =  mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    function addUser($username, $password, $email){
        $con = getConnection();
        $sql = "insert into users VALUES('', '{$username}', '{$password}', '{$email}')";        
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }

    function getUser($username, $password, $email){
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        
            // Handle Insert Operation
            if ($action === 'insert') {
                if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
                    $username = trim($_POST['username']);
                    $password = trim($_POST['password']);
                    $email = trim($_POST['email']);
        
                    if (empty($username) || empty($password) || empty($email)) {
                        echo "All fields are required for insertion.";
                    } else {
                        if (addUser($username, $password, $email)) {
                            echo "User inserted successfully!";
                        } else {
                            echo "Failed to insert user.";
                        }
                    }
                }

    }
}}

    function getAllUser(){

    }

    function updateUser($user){

    }

    function deleteUser($id){

    }
?>