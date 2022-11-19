<?php

class CreateAccount extends Controller
{
    public function __construct()
    {
        if(auth()) return redirect(DEFAULT_AUTH_ROUTE);
        $this->layout = "main";
    }
    
    public function Index()
    {
        $username = null;
        $fullname = null;

        if (isset($_POST['create_account'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $encrypt_password = md5($password);
            $confirm_password = $_POST['confirm_password'];
            $fullname = $_POST['fullname'];

            $role = 2;

            $UserModel = new UserModel;
            $user = $UserModel->where('username', $username)->where('password', $encrypt_password)->first();

            if (count($user) > 0) {
                Flash::set('warning', 'You already registered!', 'Account already exists. Please login');
                return redirect('sign-in');
            } else {
                if ($password === $confirm_password) {
                    $UserModel->create([
                        'username' => $username,
                        'password' => $encrypt_password,
                        'role' => $role,
                    ]);
                    
                    $user_id = $UserModel->last_insert_id;

                    $ProfileModel = new ProfileModel;
                    $ProfileModel->create([
                        'user_id' => $user_id,
                        'fullname' => $fullname,
                    ]);

                    Flash::set('success', 'Congratulation!', 'Account created. Please Login.');
                    return redirect('sign-in');
                } else {
                    Flash::set('warning', 'Password did\'t match!', 'Password not identical.');
                }
            }
        }
        
        $this->title = "Create Account &mdash; " . TITLE;
        $this->view('create-account', [
            'username' => $username,
            'fullname' => $fullname,
        ]);
    }
}