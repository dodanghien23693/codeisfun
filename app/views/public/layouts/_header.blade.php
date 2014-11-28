<header >
    <nav class="navbar navbar-static-top" >
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand sitename" href="<?php echo url('/'); ?>">CodeIsFun</a>		
        </div>		
        
        <div class="collapse navbar-collapse bs-navbar-collapse" >
            <ul class="nav navbar-nav">
               
                <li class="<?php if(Request::is('post')) echo 'active'; ?>"><?php echo link_to('post', 'Acticles'); ?></li>
                <li class="<?php if(Request::is('course')) echo 'active'; ?>"><?php echo link_to('course', 'Courses'); ?></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
                    <ul class="dropdown-menu" >
                        <li><a href="#">Us</a></li>
                        <li><a href="#">People</a></li>
                        <li><a href="#">Something else here</a></li>

                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
        
            <?php if (Auth::check())
            { ?>
                   <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo url('user/profile'); ?>">Profile</a></li>
                                <li><a href="<?php echo url('logout'); ?>">Logout</a></li>
                            </ul>
                       
                    </li>
                <?php }
                else
                {

                    ?>
                    <li >
                                <a href="#">
                                    <div type="button"  class="" data-toggle="modal" data-target="#loginbtn">   
                                    <span >Login</span>
                                     </div>
                                </a>
                        
            
                    </li>
                    <li>
                        <a href="#" >
                            <div type="button"  class="" data-toggle="modal" data-target="#signupbtn">   
                            <span >Signup</span>
                            </div>
                        </a>
                    </li>

                <?php } ?>
            </ul>

        </div>

    </div>
    </nav>
</header>

<!-- login form modal -->
<div class="modal fade" id="loginbtn" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="row">  
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Sign In</h4>
            </div>
            
            
                <div class="modal-body">

                    <form method="POST" action="login" accept-charset="UTF-8">
                    <input class="col-sm-12 form-control" type="text" placeholder="Username Or Email" id="identifier" name="identifier">
                    <br>
                    <input  class="col-sm-12 form-control" type="password" placeholder="Password" id="password" name="password">
                    <input type="checkbox" name="remember" id="remember-me" value="0" placeholder="Remember me">
                    <label class="control-label " class="string optional" for="user_remember_me"> Remember me</label>
                    <input class="btn btn-primary btn-block form-control" type="submit" id="sign-in" value="Sign In">
                   
                    <h4></h4>
                    
                    <a class="btn btn-facebook col-sm-6 btn-sm" href="<?php echo url('facebook') ?>"><i class="fa fa-facebook "></i> Facebook</a>
                    
                    <a class="btn btn-google-plus col-sm-6 btn-sm" href="<?php echo url('google') ?>"><i class="fa fa-google-plus"></i> Google Plus</a>
                    
                    <a class="btn btn-danger col-sm-12" href="<?php echo url('reset-password')?>">Forgot password?</a>
                    
                    <hr class="divider " />
                    <!-- end body -->
                       </form>
                </div>
            <div class="modal-footer">
            <button style="margin-top:10px; position: relative" type="button" class="btn btn-default" >Create new Account</button>   
            </div>      
        </div>
    </div>
    </div>
</div>

<!-- end login form modal -->



<!-- login form modal -->
<div class="modal fade" id="signupbtn" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="row">  
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
            </div>
            
            
            <div class="modal-body">

            {{ Form::open(array('id'=>'register_form','action'=>'AuthController@register','class'=>'form-horizontal')); }}
           
            
            {{ Form::label('first_name','First name',array('class'=>'control-label col-sm-4')); }}
            <div class="col-sm-8">
            {{ Form::text('first_name','',array('class'=>'form-control ')); }}
            </div>
            
             {{ Form::label('last_name','Last name',array('class'=>'control-label col-sm-4')); }}
             <div class="col-sm-8">
            {{ Form::text('last_name','',array('class'=>'form-control')); }}
             </div>
            {{ Form::label('username','User Name',array('class'=>'control-label col-sm-4')); }}
            <div class="col-sm-8">
            {{ Form::text('username','',array('class'=>'form-control')); }}
            </div>
        
            {{ Form::label('email','Your Email',array('class'=>'control-label col-sm-4')); }} 
            <div class="col-sm-8">
            {{ Form::email('email','',array('class'=>'form-control')); }}
            </div>
            
            {{ Form::label('password','Password',array('class'=>'control-label col-sm-4')); }} 
            <div class="col-sm-8">
            {{ Form::password('password','',array('class'=>'form-control')); }}
            </div>
            <input type="password"
            {{ Form::label('password_confirmation','Password confirm',array('class'=>'control-label col-sm-4')); }}
            <div class="col-sm-8">
            {{ Form::password('password_confirmation','',array('class'=>'form-control')); }}
            </div>
             <div class="col-sm-8">
            {{ Form::submit('Register',array('class'=>'form-control')); }}
            </div>
        
            
            
            
        {{ Form::close(); }}

        Already have an account? {{ link_to_route('login','Login') }}
                </div>
            <div class="modal-footer">
            <button style="margin-top:10px; position: relative" type="button" class="btn btn-default" >Create new Account</button>   
            </div>      
        </div>
    </div>
    </div>
</div>

<!-- end login form modal -->
@section('script')


@stop

