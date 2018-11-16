<?php
    $message = "Hello";

    $headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if (mail("dipanshuddc@gmail.com", "Password Reset", "$message", $headers)) {
        echo "Success";
    } else {
        echo "Failed";
    }
?>