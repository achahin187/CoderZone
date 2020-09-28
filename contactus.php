<?php include "include/header.php";
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    require_once "vendor/autoload.php";

    $mail = new PHPMailer();
    $mail->IsSMTP(); // send via SMTP
    $mail->Host = "ssl://smtp.gmail.com";
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = "achahin187@gmail.com"; // SMTP username
    $mail->Password = "01019342647Aa"; // SMTP password
    $mail->Port = 465;
    $mail->AddAddress("achahin187@gmail.com");
    $mail->setFrom($email, $name);
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = $subject;
    $mail->Body = $body; //HTML Body
    $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
    $msg = '';
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {

        $msg = "
        <div class='alert alert-danger ' role='alert' id='alert'  >
          Message Sent Successfully!
        </div>
        ";
    }

}
include "include\sidebar.php";

?>
<!------------------------->

<div class="col-md-9 side1" style="margin-top: 40px;">
    <h2 class="h2">Contact <span class="us">US</span> </h2>

    <form class="contact" id="myform" method="POST">

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Your Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword " placeholder="name" name="name" id="name">
            </div>

            <label for="inputPassword" class="col-sm-2 col-form-label">E-Mail</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword " placeholder="email" name="email" id="email">
            </div>

            <label for="inputPassword" class="col-sm-2 col-form-label">Subject</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword " placeholder="subject" name="subject"
                    id="subject">
            </div>


            <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label"
                style="margin-right: 10px;">Message..</label>

            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" style="width: 700px;"
                    name="body" id="body"
                    placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus voluptates distinctio id, explicabo quod voluptatem aperiam veniam beatae eos corporis deserunt provident aspernatur quasi? Exercitationem repellendus reprehenderit explicabo consectetur."></textarea>
            </div>


            <div class="save1">
                <button class="btn btn-success send" type="submit" name="submit" onclick="sendEmail()">Send</button>

            </div>
        </div>
    </form>

</div>
<!----------------------------------------------------------------------->


<?php include "include/footer.php"?>