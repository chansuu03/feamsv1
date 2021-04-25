<?php
namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index() {
        $session = session();
        if(empty($_POST)) {
            helper(['form'], ['url']);
            return view('login');
        }
        else {
            //include helper form
            helper(['form']);
            //set rules validation form
            $rules = [
                'username'         => 'required|min_length[3]|max_length[50]',
                'password'      => 'required|min_length[3]|max_length[200]',
            ];

            if($this->validate($rules)){
                $userModel = new UserModel();
                $user = $userModel->where('username', $_POST['username'])->first();
                if(!empty($user)) {
                    if($user['status'] != 'a') {
                        $session->setFlashdata('msg', 'Account not activated, please verify email');
                        return redirect()->to('/login');
                    }
                    else {
                        $pass = $user['password'];
                        $verify_pass = password_verify($_POST['password'], $pass);
                        if($verify_pass) {
                            $ses_data = [
                                'user_id'       => $user['user_id'],
                                'username'     => $user['username'],
                                'email'    => $user['email'],
                                'role'    => $user['role'],
                                'logged_in'     => TRUE
                            ];
                            $session->set($ses_data);
                        }
                        else {
                            $session->setFlashdata('msg', 'Invalid username or password?.');
                            return redirect()->back()->withInput(); 
                        }
                    }
                }
                else {
                    $session->setFlashdata('msg', 'Invalid username or password.??');
                    return redirect()->to('/login');
                }
            }
            else {
                $data['validation'] = $this->validator;
                $session->setFlashdata('msg', 'Invalid username or password.');
                return redirect()->back()->withInput(); 
            }
        }
	}
}
