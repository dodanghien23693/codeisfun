<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Neon Admin Panel">
	<meta name="author" content="">
	
	<title>Neon | Forgot Password</title>
	

	@include('admin.layouts._styles')
	
	
</head>
<body class="page-body login-page login-form-fall loaded login-form-fall-init" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var url = '<?php echo url('reset-password');?>';
</script>
	
<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.html" class="logo">
				<img src="assets/images/logo@2x.png" width="120" alt="">
			</a>
			
			<p class="description">Enter your email, and we will send the reset link.</p>
			
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
			
                    <form method="post" role="form"  id="form_forgot_password" novalidate="novalidate">
				
				<div class="form-forgotpassword-success">
					<i class="entypo-check"></i>
                                        <h3>Reset email has been sent to:</h3><span></span>
					<p>Please check your email, reset password link will expire in 10 minutes.</p>
				</div>
				
				<div class="form-steps">
					
					<div class="step current" id="step-1">
					
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-login">
								Complete Registration
								<i class="entypo-right-open-mini"></i>
							</button>
						</div>
					
					</div>
					
				</div>
				
			</form>
                    
			<script>
                            $(document).ready(function(){
                                $("#form_forgot_password1").on('submit',function(e){
                                    e.preventDefault();
                                    var url = $("#form_forgot_password").attr('action');
                                    var email = var url = $("#form_forgot_password input[name='email']").val();
                                    $.post('<?php echo route('password.request'); ?>',{email:email},function(response,status){
                                        
                                    });
                                });
                            });
                        </script>
			
			<div class="login-bottom-links">
				
				<a href="<?php echo url('login-required');?>" class="link">
					<i class="entypo-lock"></i>
					Return to Login Page
				</a>
				
				<br>
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>

	<!-- Bottom Scripts -->
	@include('admin.layouts._scripts')
	<script src="<?php echo asset('assets/backend/js/neon-forgotpassword.js') ?>"></script>

</body></html>