<?
header("Content-Type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


require_once('../config.php');

$objTrad = new Traduction;

//var dataString='name='+name+'&email='+email+'&msg='+msg;

$err="";

if(strpos($_POST['email'],"@")===false) {
	$err="err|".$objTrad->getOne('email_incorrect');
}else {	
	@list($user, $domaine) = split("@", $_POST['email'], 2);  
	if (!checkdnsrr($domaine, "MX")) $err="err|".$objTrad->getOne('email_incorrect');
	else{
		$to = 'Virginie FAURE <virfaure@gmail.com>';      
		$from = stripslashes($_POST['name']).' <'.$_POST['email'].'>';  
   
		$txt_sujet = $objTrad->getOne('sujet_email');
		
  		//subject and the html message  
		$headers = "MIME-Version: 1.0" . "\r\n";  
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";  
		$headers .= 'From: ' . $from . "\r\n";  
		
		$subject = 'Webfolio Virginie FAURE : Message de '.stripslashes($_POST['name']);   
		
		$message = '  
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"   
			"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
			<html xmlns="http://www.w3.org/1999/xhtml">  
			<head></head>  
			<body>  
			<table>  
			<tr><td>Nom : </td><td>'.stripslashes($_POST['name']).'</td></tr>  
			<tr><td>Email : </td><td>'.stripslashes($_POST['email']).'</td></tr>  
			<tr><td>Message : </td><td>'.nl2br(stripslashes($_POST['msg'])).'</td></tr>  
			</table>  
			</body>  
			</html>';  

		//send the mail  
		$result = mail($to,$subject,$message,$headers);       
		
		if ($result){
			$err="ok|".$objTrad->getOne('email_envoye');
		}else{
			$err="err|Error Sending Mail";
		}				
	}
}

echo $err;

?>