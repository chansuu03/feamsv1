<?php
namespace Modules\Users\Controllers;

use CodeIgniter\Controller;
use Modules\Users\Models\UserModel;
use Modules\Users\Models\DepartmentModel;

class Users extends \CodeIgniter\Controller {
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

    public function index() {
        //need always
        $session = session();
        $userModel = new UserModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'users';

        $data['users'] = $userModel->viewActive();

        return view('Modules\Users\Views\index', $data);
    }

    public function add() {
        //need always
        $session = session();
        $userModel = new UserModel();

        $validation =  \Config\Services::validation();
        $deptModel = new DepartmentModel();
        $data['depts'] = $deptModel->orderBy('dept_id', 'ASC')->findAll();

        if(!empty($_POST)) {
            if($deptModel->find($_POST['dept_id']) != NULL) {
                if ($validation->run($_POST, 'users') == false) {
                    // personal info
                    $data['firstname_error'] = $validation->getError('first_name');
                    $data['lastname_error'] = $validation->getError('last_name');
                    $data['middlename_error'] = $validation->getError('middle_name');
                    $data['address_error'] = $validation->getError('address');
                    $data['contact_error'] = $validation->getError('contact_number');
                    $data['birthdate_error'] = $validation->getError('birthdate');
                    $data['email_error'] = $validation->getError('email');
                    $data['gender_error'] = $validation->getError('sex');
                    // employee info
                    $data['employee_id_error'] = $validation->getError('employee_id');
                    $data['dept_error'] = $validation->getError('dept_id');
                    // account info
                    $data['username_error'] = $validation->getError('username');
                    $data['password_error'] = $validation->getError('password');
                    $data['profilepic_error'] = $validation->getError('profile_pic');

                    $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                    $data['active'] = 'users';
            
                    $deptModel = new DepartmentModel();
                    $data['depts'] = $deptModel->orderBy('dept_id', 'ASC')->findAll();
        
                    //view palang ng site
                    $session->setFlashdata('msg', '<i class="fas fa-exclamation-circle"></i> Account is not created please check fields.');
                    $session->setFlashdata('err', TRUE);
                    return view('Modules\Users\Views\add', $data);
                }
                else {
                    $session = session();
                    $userModel = new UserModel();
                    $file = $this->request->getFile('profile_pic');
                    $fileName = $file->getRandomName();

                    $date=date_create($_POST['birthdate']);
                    $dates = date_format($date,"Y-m-d");

                    $data = [
                        'employee_id'     => $this->request->getVar('employee_id'),
                        'first_name'     => $this->request->getVar('first_name'),
                        'last_name'     => $this->request->getVar('last_name'),
                        'profile_pic'     => $fileName,
                        'middle_name'     => $this->request->getVar('middle_name'),
                        'username'     => $this->request->getVar('username'),
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'email'    => $this->request->getVar('email'),
                        'contact_number'    => $this->request->getVar('contact_number'),
                        'address'    => $this->request->getVar('address'),
                        'birthdate'    => $dates,
                        'gender'    => $this->request->getVar('gender'),
                        'dept_id'    => $this->request->getVar('dept_id'),
                        'status'    => 'a',
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $userModel->save($data);
                    $file->move('../public/uploads/profile_pictures', $fileName);
                    $session->setFlashdata('msg', '<i class="fas fa-check-circle"></i> User added successfully!');
                    return redirect()->route('users/active');
                }
            }
            else {
                $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                $data['active'] = 'users';
        
                $deptModel = new DepartmentModel();
                $data['depts'] = $deptModel->orderBy('dept_id', 'ASC')->findAll();
    
                //view palang ng site
                $data['dept_error'] = 'Department not in choices.';
                return view('Modules\Users\Views\add', $data);
            }
        }
        else {
            $data['logged_in'] = $userModel->viewProfile($session->get('username'));
            $data['active'] = 'users';
    
            $deptModel = new DepartmentModel();
            $data['depts'] = $deptModel->orderBy('dept_id', 'ASC')->findAll();

            //view palang ng site
            return view('Modules\Users\Views\add', $data);
        }
    }

    public function details($username = NULL) {
        //need always
        $session = session();
        $userModel = new UserModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'users';

        $deptModel = new DepartmentModel();
        $data['depts'] = $deptModel->orderBy('dept_id', 'ASC')->findAll();
        $data['user'] = $userModel->viewProfile($username);
        //view palang ng site
        return view('Modules\Users\Views\details', $data);
    }

    public function delete($id)
    {
        $session = session();
        $userModel = new UserModel();
        $data = [
            'status'  => 'd',
        ];
        $userModel->update($id, $data);
        $userModel->where('user_id', $id);
        $userModel->delete($id);
        $session->setFlashdata('msg', '<i class="fas fa-check-circle"></i> User added successfully!');
        return redirect()->route('users/active');
    }

    public function status($id = null)
    {
        $session = session();
        $userModel = new UserModel();
        
        $user = $userModel->find($id);
        if($user['status'] == 'i') {
            echo 'inactive';
            $data = [
                'status'  => 'a',
            ];
            $userModel->update($id, $data);
            $userModel->where('user_id', $id);
        }
        elseif($user['status'] == 'a') {
            $data = [
                'status'  => 'i',
            ];
            $userModel->update($id, $data);
            $userModel->where('user_id', $id);
        }
        $session->setFlashdata('msg', '<i class="fas fa-check-circle"></i> User status updated successfully!');
        return redirect()->route('users/active');
    }
}