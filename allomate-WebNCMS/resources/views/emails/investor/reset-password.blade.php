<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title>PicPax</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;500;600;700&display=swap');

		body {
			height: 100% !important;
			margin: 0;
			padding: 0;
			width: 100% !important;
		}

		table {
			border-collapse: separate;
		}

		img,
		a img {
			border: 0;
			outline: none;
			text-decoration: none;
		}

		strong {
			font-weight: 500;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0;
			padding: 0;
		}

		p {
			margin: 1em 0;
		}

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		#outlook a {
			padding: 0;
		}

		img {
			-ms-interpolation-mode: bicubic;
		}

		body,
		table,
		td,
		p,
		a,
		li,
		blockquote {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		img {
			max-width: 100%;
			height: auto;
		}

		.main-table {
			width: 600px !important;
		}

		@media only screen and (max-width: 620px) {
			#foxeslab-email .table1 {
				width: 90% !important;
			}

			.main-table {
				width: 100% !important
			}
		}

		@media only screen and (max-width: 480px) {

			table[class="flexibleContainer"] {
				width: 100% !important;
			}

			#foxeslab-email .table1 {
				width: 100% !important;
			}
		}
        .editable-text a{
            color: white!important;
        }
	</style>
</head>

<body style="padding: 0; margin: 0;" id="foxeslab-email">

	<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#F8f8f8;">

		<tbody>
			<tr>
				<td height="20px"></td>
			</tr>
			<tr>
				<td>

					<table class="table1 main-table" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; background-color: #fff;
				border-radius: 18px;">
						<tbody>
							<tr>
								<td height="15"></td>
							</tr>

							<tr>
								<td style="padding-left:20px; padding-right:20px;">
									<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
										<tbody>
											<tr>
												<td>
													<img src="{{asset('images/allomate-logo-w.svg')}}" alt="" width="110">
												</td>

												<td mc:edit="text1203" width="50%" align="right" style="color: #000; font-size:14px;font-weight:normal; font-family:'Open Sans', sans-serif; mso-line-height-rule: exactly;">
													Date: {{date('d/m/Y')}}
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>



							<tr>
								<td height="10"></td>
							</tr>

							<tr>
								<td style="padding-left: 20px; padding-right: 20px;">
									<table class="table1 main-table" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #f4f9f7; border-radius: 18px;">
										<tbody>
											<tr>
												<td height="20"></td>
											</tr>
											<tr>
												<td style="font-family:'Lato', sans-serif; font-weight: 600;  font-size:22px; color:#000;padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="editable">
													<multiline>Password Reset</multiline>
												</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr>
												<td align="center" mc:edit="text202" class="text_color_2E2E3B" style="color: #244d80; font-size: 18px;  font-weight: 600; font-family: 'Lato', sans-serif;
											 mso-line-height-rule: exactly; padding-left: 20px; padding-right: 20px">
													<span style="color: #000;">Hi</span> {{$name}},
												</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr>
												<td style="font-family:'Open Sans', sans-serif;font-size:16px; color:#000; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="editable">
													<multiline>We received a request to reset your password for your account. Click on the below Link to set new password</multiline>
												</td>
											</tr>
											<tr>
												<td height="20"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td>
									<table class="two-left" align="center" width="100%" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td align="center" valign="top" height="30"></td>
											</tr>
											<tr>
												<td align="center" mc:edit="text202" class="text_color_2E2E3B" style="color: #565656; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; padding-left: 20px; padding-right:20px;">
													Click on the below Link to set new password
												</td>
											</tr>
											<tr>
												<td align="center" valign="top" height="50"></td>
											</tr>
											<tr>
												<td align="center" valign="top" height="50">
													<a href="{{$url}}" style="font-size:16px; color:#fff; font-weight: 600;  font-family: 'Lato', sans-serif; padding:8px 18px; text-decoration: none; background-color: #244d80;
										border-radius: 18px;">Set new password</a>
												</td>
											</tr>

											<tr>
												<td align="center" valign="top" height="30"></td>
											</tr>

											<tr>
												<td style="color: #2E2E3B; font-size:18px; font-weight:600; font-family: 'Lato', sans-serif; mso-line-height-rule: exactly;" align="center" height="45">Follow &amp; Like Us</td>
											</tr>
											<tr>
												<td align="center" valign="top" height="5"></td>
											</tr>
											<tr>
												<td style="font-size:20px; line-height:20px;" align="center" valign="top" height="30">
													<table align="center" border="0" cellspacing="5" cellpadding="5">
														<tbody>
															<tr>
																<td align="center" width="26">
																	<a href="{{@$organization->fb_link}}" target="_blank" style="border: 0 !important; opacity: 0.5;">
																		<img src="{{asset('images/facebook.png')}}" alt=""></a>
																</td>
																<td align="center" width="26">
																	<a href="{{@$organization->linkedin_link}}" target="_blank" style="border: 0 !important; opacity: 0.5;">
																		<img src="{{asset('images/linkedin.png')}}" alt=""></a>
																</td>
																<td align="center" width="26">
																	<a href="{{@$organization->insta_link}}" target="_blank" style="border: 0 !important; opacity: 0.5;">
																		<img src="{{asset('images/instagram.png')}}" alt=""></a>
																</td>
																<td align="center" width="26">
																	<a href="{{@$organization->youtube_link}}" target="_blank" style="border: 0 !important; opacity: 0.5;">
																		<img src="{{asset('images/youtube.png')}}" alt=""></a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td>
									<table align="center" border="0" cellspacing="5" cellpadding="5" style="width: 100%; max-width:100px; margin: 0 auto;">
										<tbody>
											<tr>
												<td align="right"><a href="https://demo.allomate.solutions/" target="_blank" style="color: #2E2E3B; font-size: 14px; font-weight: 600; font-family: 'Lato', sans-serif;">www.demo.allomate.solutions</a>
												</td>
												<td align="left"><a href="#" style="color: #2E2E3B; font-size: 14px; font-weight: 600; font-family: 'Lato', sans-serif;">Unsubsribe</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td height="10"></td>
							</tr>

							<tr>
								<td style="padding-left:20px; padding-right: 20px;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; background-color:#244d80; border-radius: 18px;">
										<tbody>
											<tr>
												<td height="15px"></td>
											</tr>

											<tr>
												<td mc:edit="text1201" align="left" style="color: #fff;  font-size: 13px; font-family:'Open Sans', sans-serif; mso-line-height-rule: exactly;
										padding-left:20px; padding-right: 20px;">
													<div class="editable-text" align="center" style="color:white">Copyright © {{date('Y')}}
														demo.allomate.solutions all rights reserved.</div>
												</td>
											</tr>
											<tr>
												<td height="15px"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td height="20"></td>
							</tr>
						</tbody>
					</table>

				</td>
			</tr>
			<tr>
				<td height="20px"></td>
			</tr>
		</tbody>
	</table>
</body>

</html>