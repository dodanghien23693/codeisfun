<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="CodeIsFun Admin Panel">
	<meta name="author" content="">
	
	<title>CodeIsFun | Reset Password</title>

	@include('admin.layouts._styles')

</head>
<body class="page-body login-page login-form-fall loaded login-form-fall-init" >


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var url = '<?php echo url('reset-password/'.$token); ?>';
</script>
	
<div class="login-container">
		
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">		
			<form method="post" role="form" id="form_reset_password" novalidate="novalidate">
                          
				<div class="form-register-success success-bar">
					<i class="entypo-check"></i>
					<h3>You have been successfully change password.</h3>
                                        
				</div>
                            
                                <div class="form-register-success error-bar" style='background:red'>
					<i class="entypo-cancel" style='background:red'></i>
					<h3></h3>
				</div>
                            
				<div class="form-steps">
					
					<div class="step current" id="step-1">
					   
                                            <input id='token' name='token' type='hidden' value="{{$token}}">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-lock"></i>
								</div>
								
								<input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off">
							</div>
						</div>
                                            
                                                <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-lock"></i>
								</div>
								
								<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-block btn-login">
								<i class="entypo-right-open-mini"></i>
								Change password
							</button>
						</div>
						
					</div>
					
					
				</div>
				
			</form>
			
			
			<div class="login-bottom-links">
				
				<a href="<?php echo url('login-required') ?>" class="link">
					<i class="entypo-lock"></i>
					Return to Login Page
				</a>
				<br>
			
			</div>
			
		</div>
		
	</div>
	
</div>


	@include('admin.layouts._scripts')
        <script src="<?php echo asset('assets/backend/js/neon-reset-password.js');?>"></script>

</body></html>
