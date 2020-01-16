<?php

	require 'PHPMailer/PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/PHPMailer/src/SMTP.php';
	require 'PHPMailer/PHPMailer/src/Exception.php';
	//Import PHPMailer classes into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;


	//*****************************************\/ CONFIGURAR A SENHA DE ACORDO COM O SEU SERVIDOR
	$con = mysqli_connect("localhost","root","senha","cliente");
	mysqli_query($con,'SET character_set_results=utf8');
	mysqli_query($con,"SET NAMES 'utf8'");
	mysqli_query($con,'SET character_set_connection=utf8');
	mysqli_query($con,'SET character_set_client=utf8');
	
	if(mysqli_connect_errno()) 
	{
		echo "
				<div class='card border-danger shadow-sm' >
					<div class='card-header text-white bg-danger'>
						<b>ERRO de CONEXÃO!!!</b>
					</div>
					<div class='card-body bg-light text-danger '>									
						<p class='card-text'>".mysqli_connect_error()."</p>
					</div>
				</div>
				";
		exit();
	}




function envia($email_destino,$nome_destino,$assunto_destino,$titulo_corpo,$conteudo_corpo,$link_corpo,$botao_corpo,$mensagem_sucesso,$mensagem_falha){
	/*$email_destino		=$_GET["email_destino"];
	$nome_destino		=$_GET["nome_destino"];
	$assunto_destino	=$_GET["assunto_destino"];

	$titulo_corpo		=$_GET["titulo_corpo"];
	$conteudo_corpo		=$_GET["conteudo_corpo"];
	$link_corpo			=$_GET["link_corpo"];
	$botao_corpo		=$_GET["botao_corpo"];

	$mensagem_sucesso	=$_GET["mensagem_sucesso"];
	$mensagem_falha		=$_GET["mensagem_falha"];*/

	if(($email_destino!="") AND ($nome_destino!="") AND ($assunto_destino!="") AND ($titulo_corpo!="") AND ($conteudo_corpo!="") AND ($mensagem_sucesso!="") AND ($mensagem_falha!=""))
	{

		$corpo_email = "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html style='width:100%;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>
	 <head> 
	  <meta charset='UTF-8'> 
	  <meta content='width=device-width, initial-scale=1' name='viewport'> 
	  <meta name='x-apple-disable-message-reformatting'> 
	  <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
	  <meta content='telephone=no' name='format-detection'> 
	  <title>$assunto_destino</title> 
	  <!--[if (mso 16)]>
		<style type='text/css'>
		a {text-decoration: none;}
		</style>
		<![endif]--> 
	  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
	  <!--[if !mso]><!-- --> 
	  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i' rel='stylesheet'> 
	  <!--<![endif]--> 
	  <style type='text/css'>
	@media only screen and (max-width:600px) {.st-br { padding-left:10px!important; padding-right:10px!important } p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important; text-align:center } h2 a { font-size:26px!important; text-align:center } h3 a { font-size:20px!important; text-align:center } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:16px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
	#outlook a {
		padding:0;
	}
	.ExternalClass {
		width:100%;
	}
	.ExternalClass,
	.ExternalClass p,
	.ExternalClass span,
	.ExternalClass font,
	.ExternalClass td,
	.ExternalClass div {
		line-height:100%;
	}
	.es-button {
		mso-style-priority:100!important;
		text-decoration:none!important;
	}
	a[x-apple-data-detectors] {
		color:inherit!important;
		text-decoration:none!important;
		font-size:inherit!important;
		font-family:inherit!important;
		font-weight:inherit!important;
		line-height:inherit!important;
	}
	.es-desk-hidden {
		display:none;
		float:left;
		overflow:hidden;
		width:0;
		max-height:0;
		line-height:0;
		mso-hide:all;
	}
	.es-button-border:hover {
		border-style:solid solid solid solid!important;
		background:#d6a700!important;
		border-color:#42d159 #42d159 #42d159 #42d159!important;
	}
	.es-button-border:hover a.es-button {
		background:#d6a700!important;
		border-color:#d6a700!important;
	}
	</style> 
	 </head> 
	 <body style='width:100%;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'> 
	  <div class='es-wrapper-color' style='background-color:#F6F6F6;'> 
	   <!--[if gte mso 9]>
				<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
					<v:fill type='tile' color='#f6f6f6'></v:fill>
				</v:background>
			<![endif]--> 
	   <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;'> 
		 <tr style='border-collapse:collapse;'> 
		  <td class='st-br' valign='top' style='padding:0;Margin:0;'> 
		   <table cellpadding='0' cellspacing='0' class='es-header' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;'> 
			 <tr style='border-collapse:collapse;'> 
			  <td align='center' style='padding:0;Margin:0;background-color:transparent;' bgcolor='transparent'> 
			   <!--[if gte mso 9]><v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:204px;'><v:fill type='tile' src='https://pics.esputnik.com/repository/home/17278/common/images/1546958148946.jpg' color='#343434' origin='0.5, 0' position='0.5,0' ></v:fill><v:textbox inset='0,0,0,0'><![endif]--> 
			   <div> 
				<table bgcolor='transparent' class='es-header-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;'> 
				  <tr style='border-collapse:collapse;'> 
				   <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-position:left bottom;'> 
					<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
					  <tr style='border-collapse:collapse;'> 
					   <td width='560' align='center' valign='top' style='padding:0;Margin:0;'> 
						<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
						  <tr style='border-collapse:collapse;'> 
						   <td align='center' style='padding:0;Margin:0;'><img class='adapt-img' src='http://www.sibox.com.br/novo/area_cliente/images/8921569337756127.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='330'></td> 
						  </tr> 
						</table></td> 
					  </tr> 
					</table></td> 
				  </tr> 
				</table> 
			   </div> 
			   <!--[if gte mso 9]></v:textbox></v:rect><![endif]--></td> 
			 </tr> 
		   </table> 
		   <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
			 <tr style='border-collapse:collapse;'> 
			  <td align='center' bgcolor='transparent' style='padding:0;Margin:0;background-color:transparent;'> 
			   <table bgcolor='transparent' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;'> 
				 <tr style='border-collapse:collapse;'> 
				  <td align='left' style='Margin:0;padding-bottom:15px;padding-top:30px;padding-left:30px;padding-right:30px;border-radius:10px 10px 0px 0px;background-color:#FFFFFF;background-position:left bottom;' bgcolor='#ffffff'> 
				   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td width='540' align='center' valign='top' style='padding:0;Margin:0;'> 
					   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left bottom;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='center' style='padding:0;Margin:0;'><h1 style='Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#212121;'>$titulo_corpo</h1></td> 
						 </tr> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='center' style='padding:0;Margin:0;padding-top:20px;'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#131313;'>$conteudo_corpo</p></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table></td> 
				 </tr> 
				 <tr style='border-collapse:collapse;'> 
				  <td align='left' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:30px;padding-right:30px;border-radius:0px 0px 10px 10px;background-position:left bottom;background-color:#FFFFFF;'> 
				   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td width='540' align='center' valign='top' style='padding:0;Margin:0;'> 
					   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='center' style='padding:10px;Margin:0;'><span class='es-button-border' style='border-style:solid;border-color:#2CB543;background:#FFC80A;border-width:0px;display:inline-block;border-radius:3px;width:auto;'><a href='$link_corpo' class='es-button' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#FFC80A;border-width:10px 20px 10px 20px;display:inline-block;background:#FFC80A;border-radius:3px;font-weight:normal;font-style:normal;line-height:30px;width:auto;text-align:center;'> $botao_corpo </a></span></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table></td> 
				 </tr> 
			   </table></td> 
			 </tr> 
		   </table> 
		   <table cellpadding='0' cellspacing='0' class='es-footer' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#F6F6F6;background-repeat:repeat;background-position:center top;'> 
			 <tr style='border-collapse:collapse;'> 
			  <td align='center' style='padding:0;Margin:0;background-color:transparent;' bgcolor='transparent'> 
			   <table bgcolor='#31cb4b' class='es-footer-body' align='center' cellpadding='0' cellspacing='0' width='600' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;'> 
				 <tr style='border-collapse:collapse;'> 
				  <td style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;background-position:left bottom;background-color:transparent;' align='left' bgcolor='transparent'> 
				   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td width='540' valign='top' align='center' style='padding:0;Margin:0;'> 
					   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='center' style='padding:0;Margin:0;'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:18px;color:#131313;'>SiLab - Soluções Laboratoriais - CNPJ: 29.187.746/0001-38 - São José dos Campos/SP</p></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table></td> 
				 </tr> 
				 <tr style='border-collapse:collapse;'> 
				  <td style='Margin:0;padding-bottom:5px;padding-top:15px;padding-left:20px;padding-right:30px;border-radius:0px 0px 10px 10px;background-position:left bottom;background-color:#EFEFEF;' align='left' bgcolor='#efefef'> 
				   <!--[if mso]><table width='550' cellpadding='0' cellspacing='0'><tr><td width='202' valign='top'><![endif]--> 
				   <table class='es-left' cellspacing='0' cellpadding='0' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td class='es-m-p0r es-m-p20b' width='202' align='center' style='padding:0;Margin:0;'> 
					   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left bottom;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='left' style='padding:0;Margin:0;'><img class='adapt-img' src='http://www.sibox.com.br/novo/area_cliente/images/60421569337953370.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='117'></td> 
						 </tr> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='left' style='padding:0;Margin:0;'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#3366FF;'>Soluções Laboratoriais</p></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table> 
				   <!--[if mso]></td><td width='10'></td><td width='338' valign='top'><![endif]--> 
				   <table class='es-right' cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td width='338' align='center' style='padding:0;Margin:0;'> 
					   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td class='es-m-txt-c' align='right' style='padding:0;Margin:0;padding-top:15px;'> 
						   <table class='es-table-not-adapt es-social' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
							 <tr style='border-collapse:collapse;'> 
							  <td valign='top' align='center' style='padding:0;Margin:0;padding-right:10px;'><a target='_blank' href='https://www.facebook.com/labremoto/' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:16px;text-decoration:underline;color:#FFFFFF;'><img title='Facebook' src='http://www.sibox.com.br/novo/area_cliente/images/facebook-circle-colored.png' alt='Fb' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'></a></td> 
							  <td valign='top' align='center' style='padding:0;Margin:0;padding-right:10px;'><a target='_blank' href='https://www.instagram.com/silabsjc/' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:16px;text-decoration:underline;color:#FFFFFF;'><img title='Instagram' src='http://www.sibox.com.br/novo/area_cliente/images/instagram-circle-colored.png' alt='Inst' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'></a></td> 
							  <td valign='top' align='center' style='padding:0;Margin:0;'><a target='_blank' href='https://www.youtube.com/channel/UCHthzwmL67FGhnOIBiAAXBQ' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:16px;text-decoration:underline;color:#FFFFFF;'><img title='Youtube' src='http://www.sibox.com.br/novo/area_cliente/images/youtube-circle-colored.png' alt='Yt' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'></a></td> 
							 </tr> 
						   </table></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table> 
				   <!--[if mso]></td></tr></table><![endif]--></td> 
				 </tr> 
				 <tr style='border-collapse:collapse;'> 
				  <td align='left' style='padding:0;Margin:0;background-position:left top;'> 
				   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
					 <tr style='border-collapse:collapse;'> 
					  <td width='600' align='center' valign='top' style='padding:0;Margin:0;'> 
					   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
						 <tr style='border-collapse:collapse;'> 
						  <td align='center' height='40' style='padding:0;Margin:0;'></td> 
						 </tr> 
					   </table></td> 
					 </tr> 
				   </table></td> 
				 </tr> 
			   </table></td> 
			 </tr> 
		   </table></td> 
		 </tr> 
	   </table> 
	  </div>  
	 </body>
	</html>								
		";
		/**
		 * This example shows settings to use when sending via Google's Gmail servers.
		 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
		 * example to see how to use XOAUTH2.
		 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
		 */
		 
		$mail->CharSet = 'utf-8';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "";
		//Password to use for SMTP authentication
		$mail->Password = "";
		//Set who the message is to be sent from
		$mail->setFrom('', 'CPTO'); // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< CONFIGURAR EMAIL PARA ENVIO
		//Set an alternative reply-to address
		$mail->addReplyTo('', 'CPTO'); // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< CONFIGURAR EMAIL PARA ENVIO
		//Set who the message is to be sent to
		$mail->addAddress($email_destino, $nome_destino);
		//Set the subject line
		$mail->Subject = utf8_decode($assunto_destino);
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML(utf8_decode($corpo_email));
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		if (!$mail->send()) {
			echo "<script>alert('$mensagem_sucesso!');</script>";
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//echo "<script>alert('$mensagem_falha');</script>";
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
	}
	else
	{
		echo "<script>alert('Campos insuficientes!');</script>";
	}

}



?>