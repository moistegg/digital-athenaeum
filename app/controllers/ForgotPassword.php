<?php

class ForgotPassword extends Controller
{
    public function __construct()
    {
        if(auth()) return redirect(DEFAULT_AUTH_ROUTE);
        $this->layout = "main";
    }
    
    public function Index()
    {
        $username = null;

        if (isset($_POST['reset_password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $UserModel = new UserModel;
            $user = $UserModel->where('username', $username)->first();

            if ($user) {
                if ($password === $confirm_password) {
                    $UserModel->where('username', $username)->update([
                        'password' => md5($password),
                    ])->save();

                    Flash::set('success', 'Your password has been reset', 'Please login using new set of password');
                    return redirect('sign-in');
                } else {
                    Flash::set('warning', 'Password did\'t match!', 'Password not identical.');
                }
            }
        }
        
        $this->title = "Forgot Password &mdash; " . TITLE;
        $this->view('forgot-password', [
            'username' => $username,
        ]);
    }
}