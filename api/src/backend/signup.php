<?php
   function save_data_supabase($Email, $Passwd){
    //supabase database configuration
    $SUPABASE_URL = 'https://aascgkxorhzunqnyuauh.supabase.co';
    $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFhc2Nna3hvcmh6dW5xbnl1YXVoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzODg5MTEsImV4cCI6MjA0NTk2NDkxMX0.fYi6RXVAcrS8BL03fFxZYd8mnj3rX_MFZrXUFkfAOsI';
    $url = "$SUPABASE_URL/rest/v1/users/";
    $data = [
       'email' => $Email,
       'password' => $Passwd,
    ];
    
    $options = [
       'http' => [
          'header' => "Content-Type: application/json\r\nAuthorization: Bearer $SUPABASE_KEY",
          'method'=> 'POST',
          'content' => json_decode($data),
       ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $response_data = json_decode($response, true);

    if($response === false) {
       echo "Error: Unable to save data to Supabase";
       exist;
    }
    echo "User has been created." . json_encode($response_data);
 }



   
   
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