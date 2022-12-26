<?php
    session_start();
    require("connection.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    //require 'PHPMailerAutoload.php';

    $username = $_POST["username"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    
    $query = "SELECT * FROM tbl_customers WHERE username = '$username' AND birthdate = '$birthdate' AND email = '$email'";
    //AND birthdate = '$birthdate'; 
    $result = mysqli_query($db, $query);
    
    if ($list = mysqli_fetch_array($result)) {

        // $password = $list['password'];

        // $mail = new PHPMailer(true);
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username ='compitg8@gmail.com';
        // $mail->Password ='intania63';
        // $mail->SMTPSecure ='ss1';
        // $mail->Post ='465';

        // $mail-> setFrom('compitg8@gmail.com');
        // $mail-> addAddress($email);
        // $mail-> isHTML(true);
        // $mail->Subject = "Passcode Forgot for .$email ";
        // $mail->Body = 
        // "Username : $username<br>
        // Password : $password<br><br>
        // Please Change the password next time You log in.
        // ";
        // $mail->send();

         echo '<script type="Text/JavaScript"> 
         alert("Your Password have been sent to your email");
         </script>';
        header("refresh: 0; url = login.php");
    }
    else {
        echo '<script type="Text/JavaScript"> 
            alert("Sorry, Failed to Verification, Please try again ");
            </script>';
        header("refresh: 0; url = login.php");
    }

?>