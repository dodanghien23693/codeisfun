<html lang="en"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Neon Admin Panel">
	<meta name="author" content="">
	
	<title>Neon | Login</title>
	

	@include('admin.layouts._styles')
	
</head>
<body class="page-body login-page login-form-fall loaded login-form-fall-init" data-url="http://neon.dev">

<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var url = '<?php echo url('login'); ;?>';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.html" class="logo">
				<img src="assets/images/logo@2x.png" width="120" alt="">
			</a>
			
			<p class="description">Dear user, log in to access the admin area!</p>
			
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
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Username Or Email or Password not correct!</p>
			</div>
			
                    <form method="post" action="<?php echo url('login');?>" role="form" id="form_login" novalidate="novalidate">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="identifier" id="identifier" placeholder="Username Or Email" autocomplete="off">
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>
				
				<!-- Implemented in v1.1.4 -->				<div class="form-group">
					<em>- or -</em>
				</div>
				
				<div class="form-group">
				<?php 
                                    $previous_url = '';
                                    $intended_url = Session::pull('url.intended', '/'); 
                                    if($intended_url != '/'){
                                        $previous_url = '?previous_url='.$intended_url;
                                    }
                                    
                                ?>
					<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
                                            <a href="<?php echo url('facebook'.$previous_url); ?>">Login with Facebook</a>
						<i class="entypo-facebook"></i>
					</button>
                                        <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
                                                <a href="<?php echo url('google'.$previous_url); ?>">Login with Google+</a>
                                                    <i class="entypo-gplus"></i>
                                        </button>
                                    <?php  ?>
					
				</div>
		
					
			</form>
			
			
			<div class="login-bottom-links">
				
                            <a href="<?php echo url('reset-password'); ?>" class="link">Forgot your password?</a>
				
				<br>
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>


@include('admin.layouts._scripts')
<script src="<?php echo asset('assets/backend/js/neon-login.js');?>"></script>
</body></html>