<?php

    function getConnection(){
        $con = mysqli_connect('localhost', 'root', '', 'agriculture');
        return $con;
    }

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from users where name='{$username}' and password='{$password}'";
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

    function getUser($id){

    }

    function getAllUser(){

    }

    function updateUser($user){

    }

    function deleteUser($id){

    }
?>