<?php
require('../../config/db_connection.php');
$email = $_POST['Email'];
     $pass = $_POST['Passwd'];
     $enc_pass = md5($pass);
     $query = "SELECT * from
        users
        where
        email='$email' and
        password='$enc_pass'";
     $result = pg_query($conn, $query);
     $row = pg_fetch_assoc($result);
     if($row){
        header('refresh:0; url=http://127.0.0.1/beta/api/src/Home.php');
     } else{
        echo"<script:>alert('Invalid email or password!')</script>";
        header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
     }
     pg_close($conn);
?>