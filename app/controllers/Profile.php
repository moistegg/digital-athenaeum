<?php

class Profile extends Controller
{
    public function __construct()
    {
        if (!auth()) return redirect(DEFAULT_NON_AUTH_ROUTE);
    }
    
    public function Index()
    {
        if (isset($_POST['update_profile'])) {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            
            $UserModel = new UserModel;
            $UserModel->where('id', auth()->id)->update([
                'username' => $username,
            ])->save();
            
            $ProfileModel = new ProfileModel;
            $ProfileModel->where('user_id', auth()->id)->update([
                'fullname' => $fullname,
            ])->save();

            Auth::update($UserModel->where('id', auth()->id)->first());
            Flash::set('success', 'Profile updated', 'Your profile has been updated');
        }

        if (isset($_POST['update_password'])) {
            $new_password = md5($_POST['new_password']);
            $confirm_new_password = md5($_POST['confirm_new_password']);

            if ($new_password === $confirm_new_password) {
                $UserModel = new UserModel;
                $UserModel->where('id', auth()->id)->update([
                    'password' => $new_password,
                ])->save();
    
                Flash::set('success', 'Profile updated', 'Your password has been updated');
            } else {
                Flash::set('warning', 'Password not match', 'Please make sure password are identical');
            }
        }
        
        $UserModel = new UserModel;
        $user = $UserModel->where('id', auth()->id)->first();
        
        $this->view('profile', [
            'user' => $user,
        ]);
    }
}