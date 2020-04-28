<?php {
    session_start();
    if ( isset($_POST['guvenlikKodu']) && $_POST['guvenlikKodu'] ){
        $guvenlikKontrol = false;
        if ( $_POST['guvenlikKodu'] == $_SESSION['guvenlikKodu'] ){
            $guvenlikKontrol = true;
        }
        if ( $guvenlikKontrol ){
            $text=$_POST['text'];
            $name=$_POST['name'];
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $domain=$_SERVER['HTTP_HOST'];
            $ipadress=$_SERVER['REMOTE_ADDR'];
            $date = date("d.m.Y");
            $time = date("H:i:s");
            require("class.phpmailer.php");
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host     = "mail.mediacionprivada.com.mx"; // SMTP servers
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;     // turn on SMTP authentication
            $mail->Username = "contacto@mediacionprivada.com.mx";  // SMTP username
            $mail->Password = "mediacion2020"; // SMTP password
            $mail->From     = "contacto@mediacionprivada.com.mx"; // it must be a match with SMTP username
            $mail->Fromname = "FROM NAME"; // from name
            $mail->AddAddress("contacto@mediacionprivada.com.mx","contacto@mediacionprivada.com.mx"); // SMTP username , Name Surname
            $mail->Subject  =  "Contacto desde su sitio web";
            $content = "<h2>Tienes un mensaje desde $domain</h2>  <p><b>Nombre: </b> $name</p> <p><b>Correo: </b> $email</p> <p><b>Telefono: </b> $phone</p> <br> <p><b>Mensaje: </b> $text</p> <p><h5>Fecha: $date . $time </h5></p> <p><h5>Direccion IP del cliente: $ipadress</h5> </p><p><h5>Este mensaje fue enviado desde tu formulario de contacto</h5></p>";
            $mail->MsgHTML($content);
            if(!$mail->Send())
            {
                echo "<center>Error! hay algo mal :</center>";
                echo "Mailer Error: " . $mail->ErrorInfo;
                echo "<center><p><input type='submit' onclick='gostergizle();' value='Regresar' /></p></center>";
                exit;
            }
            echo "<script>alert('¡Mensaje enviado satisfactoriamente!'); document.location.href='#'</script>";
        } else {
            echo "<script>alert('Hubo un error! Ingresa toda la información correctamente e intenta de nuevo...'); location.reload();</script>";
        }
    }
}
?>
