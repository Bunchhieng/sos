<!--* These links need to be included. -->
<!-- Bootstrap core CSS -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome core css -->
<link rel="stylesheet" href="css/font-awesome.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/carousel.css" rel="stylesheet" type="text/css">
<!-- Modified bootstrap css -->
<link rel="stylesheet" href="css/modified.css" type="text/css">

<!-- image and description need to align -->
<div class="content" style="text-align:left">
    <div class="container">
        <h2 class="featurette-heading">Are you eligible to get free meals?</h2>
        <hr class="featurette-divider">
        <h3>If you can answer yes to any of the questions below you are eligible to receive meals from SOS:</h3>
        <ol style="font-size:20px; line-height: 220%">
            <li>Did you worry about whether or not your food would run out before you got money to buy more?</li>
            <li>Did the food that you bought run out and you didn't have enough money to get more?</li>
            <li>Were you unable to afford balanced meals?</li>
            <li>In the last 12 months, did you ever cut the size of your meals or skip meals because there wasn't enough money for food?</li>
            <li>In the last 12 months, did you ever eat less than you felt you should because there wasn't enough money for food?</li>
            <li>In the last 12 months, were you ever hungry but didn't eat because there wasn't enough money for food?</li>
            <li>In the last 12 months, did you lose weight because there wasn't enough money for food?</li>
            <li>In the last 12 months, did you ever not eat for a whole day because there wasn't enough money for food?</li>
        </ol>

        <p><span style="color:red">*</span>&nbsp;Questions adapted from the USDA Food Security Survey</p>

    </div>

    <!-- FORM PHP CODE HERE -->
    <?php
    // Email to send info
    $email_to = "Bunchhieng@gmail.com";

    // define variables and set to empty values for error messages
    $fnameErr = $lnameErr = $emailErr = $idErr = "";
    $fname = $lname = $email = $id = "";
    $string_exp = "/^[A-Za-z .'-]+$/";
    $thankYou = "";
    /*****************************************
    * Eligibility Form                       *
    *****************************************/
    // If form has submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // check if first name is empty
      if (empty($_POST["fname"])) {
        $fnameErr = "First name is required";
      } else {
        $fname = test_input($_POST["fname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
          $fnameErr = "Only letters and white space allowed.";
        }
      }
      // check if last name is empty
      if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
      } else {
        $lname = test_input($_POST["lname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
          $lnameErr = "Only letters and white space allowed.";
        }
      }
      // check if email is empty
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format.";
        }
      }
      // check if ID is empty
      if (empty($_POST["id"])) {
        $idErr = "Student ID is required";
      } else {
        $id = test_input($_POST["id"]);
        // check if email address is well-formed
        if (!ctype_digit($id) || strlen($id) != 8) {
          $id = "Invalid Student ID. ID must be 8 digits long.";
        }
      }
      $thankYou = "Thank you for contacting us. We will contact you as soon as we review your message.";
      $email_subject = "I want to check if I am eligible for SOS program.";
      $email_message = "A student has applied for the SOS food program.\n\n";
      $email_message .= "First Name: ".clean_string($fname)."\n";
      $email_message .= "Last Name: ".clean_string($lname)."\n";
      $email_message .= "Email: ".clean_string($email)."\n";
      $email_message .= "Student ID: ".clean_string($id)."\n";
      $email_message .= date('l \t\h\e jS');

      $headers = 'From: '.$email."\r\n".

      'Reply-To: '.$email."\r\n" .

      'X-Mailer: PHP/' . phpversion();

      mail($email_to, $email_subject, $email_message, $headers);
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }
    ?>
    <!-- END PHP CODE -->
    <!--
        Form
            First/Last:
            Email:
            StudentID:
            -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="donate_form">
                        <fieldset>
                            <legend class="text-center header">Contact US</legend>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <!-- donate_fname -->
                                    <input name="fname" type="text" placeholder="First Name" class="form-control">
                                    <span class="errorForm">* <?php echo $fnameErr;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <!-- donate_lname -->
                                    <input name="lname" type="text" placeholder="Last Name" class="form-control">
                                    <span class="errorForm">* <?php echo $lnameErr;?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <!-- donate_email -->
                                    <input name="email" type="text" placeholder="Email Address" class="form-control">
                                    <span class="errorForm">* <?php echo $emailErr;?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-keyboard-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <!-- donate_ID -->
                                    <input name="id" type="text" placeholder="Your Student ID" class="form-control">
                                    <span class="errorForm">* <?php echo $idErr;?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Submit" name="eligibility_submit">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                      echo "<div class='thankYou'>";
                      echo $thankYou;
                      echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
