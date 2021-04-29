<?php
namespace App\Controllers;

use App\Models\UserModel;
use Modules\Users\Models\LoginModel;

class Login extends BaseController
{
    public function index() {
        $session = session();
        $loginModel = new LoginModel();
        
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
                            
                            // pass login details to database
                            date_default_timezone_set('Asia/Manila');
                            $date = date('Y-m-d H:i:s', time());
                            $loginDetails = [
                                'user_id' => $user['user_id'],
                                'role_id' => $user['role'],
                                'login_date' => $date,
                                'created_at' => $date,
                            ];

                            if($loginModel->loginDetails($loginDetails)) {
                                return redirect()->to('home');
                            }
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

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url().'/');
    }
}
