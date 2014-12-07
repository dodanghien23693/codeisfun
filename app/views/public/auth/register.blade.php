<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="CodeIsFun Admin Panel">
	<meta name="author" content="">
	
	<title>CodeIsFun | Register</title>

	@include('admin.layouts._styles')

	
</head>
<body class="page-body login-page login-form-fall loaded login-form-fall-init" >


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var url = '<?php echo url('register'); ?>';
</script>
	
<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.html" class="logo">
				<img src="assets/images/logo@2x.png" width="120" alt="">
			</a>
			
			<p class="description">Create an account, it's free and takes few moments only!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>0%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">		
			<form method="post" role="form" id="form_register" novalidate="novalidate">
				
				<div class="form-register-success">
					<i class="entypo-check"></i>
					<h3>You have been successfully registered.</h3>
                                        
				</div>
                            
                                <div class="form-register-success error-bar" style='background:red'>
					<i class="entypo-cancel" style='background:red'></i>
					<h3></h3>
                                        <button id="try-again" class="btn btn-info">Try again</button>
				</div>
                            
				<div class="form-steps">
					
					<div class="step current" id="step-1">
					
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" autocomplete="off">
							</div>
						</div>
                                                <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" autocomplete="off">
							</div>
						</div>
                                                <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user-add"></i>
								</div>
								
								<input type="text" class="form-control" name="username" id="username" placeholder="Username" data-mask="[a-zA-Z0-1\.]+" data-is-regex="true" autocomplete="off">
							</div>
						</div>
					
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
								Complete Registration
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
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>


	@include('admin.layouts._scripts')
        <script src="<?php echo asset('assets/backend/js/neon-register.js');?>"></script>
        <script>
            $(document).ready(function(){
                $("form-register-success #try-again").click(function(e){
                    e.preventDefault();
                    $(".login-page .login-header .description").slideDown();
                    neonLogin.resetProgressBar(true);
                    neonRegister.setPercentage(0);
                });
            });
            </script>
</body></html>
