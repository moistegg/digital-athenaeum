<?php

class SignIn extends Controller
{
    public function __construct()
    {
        if (auth()) return redirect(DEFAULT_AUTH_ROUTE);
        $this->layout = "main";
    }
    
    public function Index()
    {
        $username = null;

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $UserModel = new UserModel;
            $user = $UserModel->where('username', $username)->where('password', $password)->first();

            if(!empty($user)) {
                Auth::set($user);
                return redirect('');
            } else {
                Flash::set('warning', 'Account not found!', 'Invalid <strong>Username</strong> or <strong>Password</strong>.');
            }
        }
        
        $this->title = "Sign In &mdash; " . TITLE;
        $this->view('sign-in', [
            'username' => $username,
        ]);
    }
}