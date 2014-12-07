<?php

class AuthController extends BaseController {

    public function getRegister()
    {
        return View::make('public.auth.register');
    }

    public function register()
    {
    
        if(Request::ajax()){
            $username = Input::get('username');
            $email = Input::get('email');
            $status = '';
            $message = '';
            
            if(User::where('username','=',$username)->count()){
                   $status = 'invalid';
                   $message = 'username has already exist';
            };
            
            if(User::where('email','=',$email)->where('user_type','=','codeisfun')->count()){
                $status = 'invalid';
                $message = 'this email has registered! please enter anothor email';

            }
            
            if(User::where('email','=',$email)->where('user_type','=','facebook')->count()){
                $status = 'invalid';
                $message = 'this email has registered via facebook account! please login with facebook';

            }
            if(User::where('email','=',$email)->where('user_type','=','google')->count()){
                $status = 'invalid';
                $message = 'this email has registered via google+ account! please login with google+';
            }
            
            $user = new User();
            
            $user->setAttribute('first_name',Input::get('first_name'));
            $user->setAttribute('last_name' ,Input::get('last_name'));
            $user->setAttribute('username', Input::get('username'));
            $user->setAttribute('email', Input::get('email'));
            $user->setAttribute('password' , Hash::make(Input::get('password')));
            $user->setAttribute('role_id', 1); //role là user
            $user->setAttribute('user_type' , 'codeisfun');
            
            if($user->save()){
                $status = 'success';
                $message = 'Registration has been successful!';
            }
            
            return Response::json(array(
                    'status'=> $status,
                    'message'=> $message
                ));
        }
        // ajax response        
        $inputData = Input::get('formData');

        parse_str($inputData, $formFields);


        if (strlen($formFields['password'])<6){
            return Response::json(array(
                        'fail' => true,
                        'errors' => array('password' => 'password phải có ít nhất 6 ký tự'),
            ));
        }
        
        elseif ($formFields['password'] != $formFields['password_confirmation'])
        {
            return Response::json(array(
                        'fail' => true,
                        'errors' => array('password' => 'password không khớp với với password_confirmation'),
            ));
        }
        else
        {
            $user = new User();
            
                $user->setAttribute('first_name',$formFields['first_name']);
                $user->setAttribute('last_name' ,$formFields['last_name']);
                $user->setAttribute('username', $formFields['username']);
                $user->setAttribute('email', $formFields['email']);
                $user->setAttribute('password' , Hash::make($formFields['password']));
                $user->setAttribute('role_id', 1);
                $user->setAttribute('user_type' , 'codeisfun');

        

            if (!$user->save())
            {
                return Response::json(array(
                            'fail' => true,
                            'errors' => $user->validationErrors->toArray(),
                ));
            }
            else
            {
                return Response::json(array(
                            'success' => true,
                            'email' => $user->getAttribute('email'),
                            'message' => '<div class="message"><h3>Đăng ký thành công!!!</h3><h4>Đăng nhập vào hệ thống ngay:'. link_to_route('login', 'Login'),
                ));
            }
        }

  
    }

    // login
    public function getLogin()
    {
        if(Auth::check())
        {
            return Redirect::to('/');
        }
        return View::make('public.auth.login_form');
    }

    public function login()
    {

        
        if(Auth::check())
        {
            return Redirect::to('/');
        }
        
        if(Request::ajax()){
            
            $previous_url = Input::get('previous_url');
            
            
            $login_status = "";
            $redirect_url ='';
            $message = '';
            $user = User::where('username', '=', Input::get('identifier'))->first();
            if (!isset($user))
            {
                $user = User::where('email', '=', Input::get('identifier'))
                        ->where('user_type', '=', 'codeisfun')
                        ->first();
            }
            

            if (isset($user))
            {
                if (Hash::check(Input::get('password'), $user->password))
                {
                    if (Input::get('remember')) Auth::login($user, true);
                    else Auth::login($user, false);
                    
                }
            }

            if (Auth::check())
            {
                $login_status = 'success';
                $redirect_url = $previous_url;
                //return View::make('public.auth.login_form')->with('success', 'Đăng nhập thành công');
            }

            // Nếu thất bại thì thông báo thất bại
            else
            {
                $login_status = 'invalid';
                
            }
            
            return Response::json(array(
                'login_status' => $login_status,
                'redirect_url' =>$redirect_url
            ));
        }
       
    }
    // logout
    public function logout()
    {
        if (Auth::check())
        {
            Auth::logout();
            return Redirect::to(URL::previous());
        }
        else{
            return Redirect::to('/');
        }
    }

    // page that a user sees if they try to do something that requires an authed session
    public function getLoginRequired()
    {
        return View::make('public.auth.login_form')->with('error', 'Bạn cần đăng nhập trước mới có quyền truy cập vào địa chỉ này!');
        
    }

    public function loginRequired()
    {
        
    }



    public function userIsBanned($user)
    {
        
    }


    /**
     * Login user with facebook
     *
     * @return void
     */
    
    public function loginWithFacebook()
    {

        // get data from input
        $code = Input::get('code');
        $previous_url = Input::get('previous_url');
        if($previous_url) Session::put('return.url',$previous_url);
       
        // get fb service
        $fb = OAuth::consumer('Facebook');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!empty($code))
        {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me'), true);

            //$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            //display whole array(). 

            $user = User::where('email', '=', $result['email'])->first();


            if (!isset($user)) //tài khoản chưa tồn tại
            {
                //Thêm vào csdl
                $user = new User();
                $user->setAttribute('username', $result['id']);
                $user->setAttribute('email', $result['email']);
                $user->setAttribute('first_name', $result['first_name']);
                $user->setAttribute('last_name', $result['last_name']);
                $user->setAttribute('password', Hash::make($result['id']));
                
                $user->setAttribute('user_type', 'facebook');
                $user->setAttribute('role_id', 1);
                $user->setAttribute('gender', $result['gender']);
                $user->setAttribute('facebook_link', $result['link']);
                if (isset($result['birthday']))
                        $user->setAttribute('birthday', $result['birthday']);

                $user->save();
            }
            else
            { //Tài khoản đã tòn tại
                if ($user->getAttribute('user_type') == 'codeisfun') //đã tạo tài khoản bằng địa chỉ mail liên kết với facebook này
                {
                    return View::make('public.auth.login_form')->with('error', 'Đã tạo tài khoản bằng địa chỉ mail liên kết với facebook! Bạn vui lòng đăng nhập bằng tài khoản đã tạo');
                }
                if ($user->getAttribute('user_type') == 'google') //đã liên kết tài khoản với google
                {
                    return View::make('public.auth.login_form')->with('error', 'Địa chỉ male từ facebook của bạn đã được liên kết với tài khoản google! Xin hãy đăng nhập bằng google');
                }
            }
            //đăng nhập vào tài khoản
            Auth::login($user);
            
            return Redirect::to(Session::pull('return.url', '/'));
        }
        // if not ask for permission first
        else
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();
            

            // return to facebook login url      
            return Redirect::to((string)$url);
        }
    }

    /**
     * 
     * @return typeLogin user with google
     * 
     * @return void
     */
    public function loginWithGoogle()
    {
        // get data from input
        $code = Input::get('code');
        $previous_url = Input::get('previous_url');
        if($previous_url) Session::put('return.url', $previous_url);
        // get google service
        $googleService = OAuth::consumer("Google");

        if (!empty($code))
        {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            //display whole array(). 



            $user = User::where('email', '=', $result['email'])->first();

            if (!isset($user)) //tài khoản chưa tồn tại
            {
                //Thêm vào csdl
                $user = new User();
                $user->setAttribute('username', $result['id']);
                $user->setAttribute('email', $result['email']);
                $user->setAttribute('first_name', $result['given_name']);
                $user->setAttribute('last_name', $result['name']);
                $user->setAttribute('password', Hash::make($result['id']));
                
                $user->setAttribute('user_type', 'google');
                $user->setAttribute('role_id', 1);
                $user->setAttribute('gender', $result['gender']);
                $user->setAttribute('google_link', $result['link']);
                if (isset($result['birthday']))
                        $user->setAttribute('birthday', $result['birthday']);
                if (isset($result['picture']))
                        $user->setAttribute('photo_url', $result['picture']);
                $user->save();
            }
            else
            { //Tài khoản đã tồn tại
                if ($user->getAttribute('user_type') == 'codeisfun') //đã tạo tài khoản bằng địa chỉ mail liên kết với google này
                {
                    return View::make('public.auth.login_form')->with('error', 'Đã tạo tài khoản bằng địa chỉ mail liên kết với google! Bạn vui lòng đăng nhập bằng tài khoản đã tạo');
                }
                if ($user->getAttribute('user_type') == 'facebook') //đã liên kết tài khoản với facebook
                {
                    return View::make('public.auth.login_form')->with('error', 'Địa chỉ male google của bạn đã được liên kết với tài khoản facebook! Xin hãy đăng nhập bằng facebook');
                }
            }
            //đăng nhập vào tài khoản
            Auth::login($user);
            return Redirect::to(Session::pull('return.url', '/'));
        }
        // if not ask for permission first
        else
        {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to((string)$url);
        }
    }

    /**
     * 
     * Reset password function
     */
    public function remindPassword()
    {
        return View::make('public.auth.forgot-password');
    }

    
    public function requestPassword()
    {
        $credentials = array('email' => Input::get('email'));
        
        return Response::json(array(
            'submitted_data' => array(
                'email' => Input::get('email'),
            ),
            'message' => Password::remind($credentials)
        ));
        \Illuminate\Auth\Reminders\PasswordBroker::remind($credentials);
    }

    
    
    public function resetPassword($token)
    {
        return View::make('public.auth.reset_password')->with('token', $token);
    }

    
    public function updatePassword()
    {
    if(Request::ajax()){    
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'password_confirmation' => Input::get('password_confirmation'),
                'token' => Input::get('token'));
            
           
           $status = Password::reset($credentials, function($user, $password) {

                        $user->password = Hash::make($password);   
                        $user->updateUniques();
           });
           
           if($status=='invalid') //email khong dung
           {
               return Response::json(array(
                   'status' => 'invalid',
                   'message' => 'Email không hợp lệ. vui lòng nhập lại'
               ));
           }
           if($status=='invalid token'){
               return Response::json(array(
                   'status' => 'invalid',
                   'message' => 'Token invalid or expired'
               ));
           }
           else
           {
               return Response::json(array(
                   'status' => 'success',
                   'message' => 'Thay Đổi mật khẩu thành công!'
               ));
           }
        }
        
    }

}
