<?php


if(isset($_POST['submit'])){
	
	
// $startTime =  date("Y-m-d H:i:a");
$startTime = date('Y-m-d H:i:a',strtotime('+5 hour +30 minutes'));
$today = $startTime;
	
	$url='https://www.google.com/recaptcha/api/siteverify';
	$privatekey='6LefWpcUAAAAADz4gdvx9Curk2lJq7MN3A4i9cdo';
	
	$response= file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
	$data = json_decode($response);
	
	if(isset($data->success) AND $data->success==true){
	
    $name = $_POST['name'];  
    $email = $_POST['email']; 
	$phone = $_POST['phone']; 
	$message = $_POST['message'];
    $today = $today; 

    $body= "From: $name<br/>  E-Mail: $email <br/> Phone: $phone <br/> Message: $message <br/> Date: $today";
		
		$to='jareerzeenam.28@gmail.com';
		
		$subject ='Email Subject';
		// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
			$headers .= 'From: '.$email . "\r\n";
				
			mail($to, $subject, $body, $headers);
			
			echo "<script type='text/javascript'>alert('Thank You! We will get back to you soon.');</script>";
			
		}else{
			echo "<script type='text/javascript'>alert('Complete form security check, Try Again.');</script>";
		}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send email on form submit using PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--! Recapcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h5>Fill form and submit to send email</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="John">
                    </div>
                    <div class="form-group">
                        <label for="phone">Your Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="0XX XXX XXXX">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="john@example.com">
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Hi Abc,"></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LefWpcUAAAAADm-sNgajPL9rPVWaIyoFT2ckzoy"></div><br>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>