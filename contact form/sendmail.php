<?php

use PHPMailer\PHPMailer\PHPMailer;
  $connection = mysqli_connect('localhost','root');
      mysqli_select_db($connection,'database name');
        $query = "SELECT * FROM example";
        $rows=mysqli_query($connection, $query);

    if (isset($_POST['name']) && isset($_POST['form'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['tel'];
        $website = $_POST['url'];
        $message = $_POST['message'];

        foreach($rows as $row){
            send_mail($row['email'], $row['name'], $number, $website, $message);
            
        }

    }
function send_mail($to, $name, $email, $number,$website,$message){
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "anurabi77@gmail.com";
        $mail->Password = '*******';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('anurabi77@gmail.com' );
        $mail->addAddress('anurabi77@gmail.com');
        $mail->Subject = 'message received(contact page';
        $mail->Body = '<h3>name:$name <br>email:$email <br>number:$number <br>website:$website <br>message:$message </h3>';

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        print (json_encode(array("status" => $status, "response" => $response)));
    }
    
?>
