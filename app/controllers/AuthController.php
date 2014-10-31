<?php


class AuthController extends BaseController
{
    
    public function getRegister()
    {
        return View::make('public.auth._register_form');
    }
    
    
    public function register()
    {
        dd(Input::all());
    }
    
    // login
    public function getLogin()
    {
        return View::make('public.auth._login_form');
    }

    public function login()
    {
        dd(Input::all());
    }
    // logout
    public function logout()
    {
        
    }

    // page that a user sees if they try to do something that requires an authed session
    public function getLoginRequired()
    {
       
    }

    // the confirmation page that shows a user what their new account will look like
    public function getSignupConfirm()
    {
        
    }

    // actually creates the new user account
    public function postSignupConfirm()
    {
       
    }

    // user creator responses
    public function userValidationError($errors)
    {
        return Redirect::to('/');
    }

    public function userCreated($user)
    {
       
    }

    // github account integration responses
    public function userFound($user)
    {
       
    }

    public function userIsBanned($user)
    {
        
    }

    public function userNotFound($githubData)
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

            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message . "<br/>";

            //display whole array(). 
            dd($result);
            
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
    public function loginWithGoogle() {
        // get data from input
        $code = Input::get('code');
        
        // get google service
        $googleService = OAuth::consumer("Google");

        if (!empty($code)) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $user = User::where('email','=',$result['email'])->get();
            

            if (empty($user)) {
                // create new User data
            }
            
            
            //Auth::login($user);
            dd($result);

        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to((string)$url);
        }
    }

}
