<?php

header("Access-Control-Allow-Origin: https://octaviotchikete.com/");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Content-Type");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
require '../vendor/autoload.php';

//$template_email_file = "../email/emailDentroPassageiro.php";
// //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$nome_client_user = $_POST['nome'];
$email_client_user = $_POST['email'];
$message_client_user = $_POST['message'];

 //create the swap_variable_array
// $swap_var = array(
//     "{--client-name--}" => trim($nome_client_user),
//     "--start-date--" => $startDate,
//     "--end-date--" => $endDate,
//     "--id--" => $id,
//     "--email--" => trim($email_client_user),
//     "--DATAEHORA--"=> (
//         Funcoes::quando($startDate) .' - '. Funcoes::quando($endDate)
//     )

// );

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.octaviotchikete.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@octaviotchikete.com';                     //SMTP username
    $mail->Password   = 't5wdk[zN#T_t';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@octaviotchikete.com', 'OctavioTchikete.com Info');
    $mail->addAddress(trim($email_client_user), trim($nome_client_user)); //Add a recipient

    // if(file_exists($template_email_file)){
    //     $body = file_get_contents($template_email_file);
    // }

    // else {
    //     die("unable to locate the template file");
    //     exit();
    // }

    $message = $message_client_user;

    // // Iterate through the keys of swap_var
    // foreach (array_keys($swap_var) as $key) {
    //     if (strlen($key) > 2 && trim($key) != '') {
    //         // Replace the placeholders and concatenate to $message
    //         $message = str_replace($key, $swap_var[$key], $message);
    //      }
    //  }

    
  
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Obtenha o seu relatorio';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // $response = array(
    //     "success" => true,
    //     'startDate'=> $startDate,
    //     'endDate'=> $endDate,
    //     'id'=> $id
    // );
    
}  
 catch (Exception $e) {
     $response = array("success" => false, "error" => $mail->ErrorInfo);
     }
 // Converta a resposta em JSON e imprima

header('Content-Type: application/json');
//echo json_encode($response);
?>