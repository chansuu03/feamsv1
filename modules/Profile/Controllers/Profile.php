<?php
namespace Modules\Profile\Controllers;

use CodeIgniter\Controller;
use Modules\Users\Models\UserModel;
use Modules\Users\Models\DepartmentModel;

class Profile extends \CodeIgniter\Controller
{
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

  	public function index() {
        $session = session();
        
        if(!session()->has('logged_in')) {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
        else {
            $session = session();
            $userModel = new UserModel();
            $data['logged_in'] = $userModel->viewProfile($session->get('username'));
    
            $data['username'] = $session->get('username');
            $data['user'] = $userModel->viewProfile($data['username']);
            $data['active'] = 'profile';
    
            return view('Modules\Profile\Views\index', $data);
        }
  	}

    // public function viewProfile($id = null) {
    //     die($id);
    //     $session = session();
    //     $data['username'] = $session->get('username');
    //     $userModel = new UserModel();
    //     $deptModel = new DepartmentModel();

    //     $data['users'] = $deptModel->profile($id);
    //     $data['module_title'] = $data['users'][0]->username;

    //     $data['user'] = $userModel->where('user_id', $id)->first();
    //     $data['id'] = $data['users'][0]->user_id;
    //     return view('Modules\Users\Views\profile', $data);
    // }

    public function update($username = null) {
        $session = session();
        
        if(!session()->has('logged_in')) {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
        else {
            if(!session()->get('username') == $username) {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
            else {
                $userModel = new UserModel();
                $data = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'email' => $this->request->getVar('email'),
                ];
                if($userModel->where('username', $username)->set($data)->update()) {
                    $session->setFlashdata('msg', 'Successfully updated profile');
                    return redirect()->back();
                }
            }
        }
    }
}
