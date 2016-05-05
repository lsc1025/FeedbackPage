<?php
$error = "";
$emailMsg = "";

if ($_POST) {

    if (!$_POST["email"]){
        $error .= "An email is required<br>";
    }
    if (!$_POST["subject"]){
        $error .= "A subject is required<br>";
    }
    if (!$_POST["content"]){
        $error .= "A message is required<br>";
    }
    if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
        $error .= "Invalid email address";
    }

    if ($error != "") { // server side error detection
        $error = '<div class="alert alert-warning" role="alert"><p><strong>Error(s):</strong></p>'.$error.'</div>';


    } else {

        $emailTo = "admin@xeoninside.tk";
        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $hearder = "From: ".$_POST["email"];

        if (mail($emailTo,$subject,$content,$hearder)) {
            $emailMsg = '<div class="alert alert-info" role="alert">Message sent successfully!</div>';
        } else {
            $emailMsg = '<div class="alert alert-warning" role="alert"><strong>Error(s):</strong>Something goes wrong, try again later</div>';
        }

    } // send the message otherwise

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Get in Touch</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

</head>
<body>

    <div class="container">
        <h1>Get in touch to me!</h1>

        <div id="err">
            <?  echo $error.$emailMsg; ?>
        </div>

        <form method="post">
            <fieldset class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" />
                <small class="text-muted">We'll never share your email with anyone else.</small>
            </fieldset>

            <fieldset class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="" />
            </fieldset>


            <fieldset class="form-group">
                <label for="content">Your message to us</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </fieldset>

            <fieldset class="form-group">
                <label for="attach">Attachment</label>
                <input type="file" class="form-control-file" name="attach" id="attach" />
                <small class="text-muted">Optional</small>
            </fieldset>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="check" />Please identify whether you want to be reached by us in the future
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $("form").submit(function (e) {

            e.preventDefault(); //prevent immedate submission

            var errMsg = "";
            if ($("#email").val() == "")
                errMsg += "<p>Please enter a email address!</p>";
            if ($("#subject").val() == "")
                errMsg += "<p>Please enter a subject!</p>";
            if ($("#content").val() == "")
                errMsg += "<p>Please enter a message!</p>";// set the error messages

            if (errMsg != "") {
                $("#err").html( // set bootstrap alert style alerts
                   '<div class="alert alert-warning" role="alert"><strong>Error(s):</strong>' + errMsg + '</div>');
            } else {
                $("form").unbind('submit').submit(); //submit the form
            }

        });

    </script>

</body>
</html>