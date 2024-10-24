<?php
    //db connection
    require('../../config/db_connection.php');
    
    //get data from register form


     $email = $_POST['Email'];
     $pass = $_POST['Passwd'];
     $enc_pass = md5($pass);

     //validate if email already exists

     $query = "SELECT * FROM users Where email ='$email'";
     $result = pg_query($conn, $query);
     $row = pg_fetch_assoc($result);

     if($row){
        echo "<script>alert('email already exists')</script>";
        header('refresh:0; url=http://127.0.0.1/beta/api/src/register_form.html'); 
        exit();
     }
     /*echo "Email: " . $email;
     echo "Passwd: " . $pass;
     echo "<br>Enc. Password: ". $enc_pass;
*/
     $query = "INSERT INTO users (email, password)
        VALUES ('$email', '$enc_pass')";
    $result = pg_query($conn, $query);

        if ($result){
            echo "<script>alert('Registration succesfull')</script>";
            header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
        } else {
            echo "Register failed";
        }
    
        pg_close($conn);

?>