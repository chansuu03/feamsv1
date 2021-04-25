<?php
namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
	public function index() {
		helper(['form', 'url']);
		return view('register');
	}

	public function verify() {
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		$model = new UserModel();
		$email = \Config\Services::email();
		helper('text');
        $session = session();

		$code = random_string('alnum', 12);

		$data = [
			'first_name' => $this->request->getVar('first_name'),
			'middle_name' => $this->request->getVar('middle_name'),
			'last_name' => $this->request->getVar('last_name'),
			'username' => $this->request->getVar('username'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
			'email' => $this->request->getVar('email'),
			'email_code' => $code,
			'status' => 'd'
		];
		
		if($model->save($data)) {
			$user = $model->where('username', $_POST['username'])->first();
			// message
			$message = 	"<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering. ".$user['first_name']. " ". $user['last_name']."</h2>
							<p>Your Account:</p>
							<p>Email: ".$_POST['email']."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."/register/activate/".$user['user_id']."/".$code."'>Activate My Account</a></h4>
						</body>
						</html>
						";
			// execute code
			$email->clear();
			$email->setFrom('facultyea@gmail.com');
			$email->setTo($_POST['email']);
			$email->setSubject('Signup Verification Email');
			$email->setMessage($message);
			if($email->send()) {
                $session->setFlashdata('msg', 'Activation email sent, please check mail to verify');
				return redirect()->to('/login');
			}
			else {
				die($email->printDebugger());
			}
		}
		else {
			$data['validation'] = \Config\Services::validation()->getErrors();
			echo view('register', $data);
		}
	}

	public function activate() {
		$uri = new \CodeIgniter\HTTP\URI();
        $id = $this->request->uri->getSegment(3);
        $code = $this->request->uri->getSegment(4);

		$model = new UserModel();
		//fetch user details
		$user = $model->where('user_id', $id)->first();

		if($user['email_code'] == $code) {
            if($user['status'] == 'a') {
                $session = session();
                $session->setFlashdata('msg', 'Account already activated! Please login.');
                return redirect()->to('/login');
            }
            else {
                $data = [
                    'status' => 'a'
                ];
                if($model->update($id, $data)) {
                    $session = session();
                    $session->setFlashdata('msg', 'Account activated!');
                    return redirect()->to('/login');
                }
                else {
                    die('Activation failed, contact admin.');
                }
            }
        }
        else {
            die('Activation code error, please contact admin.');
        }
	}
}
