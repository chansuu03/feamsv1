<?php
namespace Modules\Announcements\Controllers;

use CodeIgniter\Controller;
use App\Controllers\UserFilter;
use Modules\Announcements\Models\AnnouncementsModel;
use Modules\Users\Models\UserModel;

class Announcements extends \CodeIgniter\Controller
{
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

    public function index() {
        $session = session();

        if($session->get('logged_in') != true) {
            session()->setFlashdata('msg', '404 error');
            return redirect()->to(base_url() . '/profile/' . $session->get('username'));
        }
        else {
            if($session->get('role') != 1) {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
            else {
                //need always
                $userModel = new UserModel();
                $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                $data['active'] = 'announcements';
                $annModel = new AnnouncementsModel();
                $data['announce'] =  $annModel->view();
                return view('Modules\Announcements\Views\index', $data);
            }
        }
    }

    public function details($id = null) {
        $session = session();
        $annModel = new AnnouncementsModel();
        $data['announce'] =  $annModel->where('ann_id', $id)->first();
        if($data['announce'] == null) {
            if($session->get('logged_in') == true) {
                session()->setFlashdata('msg', '404 error');
                return redirect()->to(base_url() . '/profile/' . $session->get('username'));
            }
            else {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
        }
        else {
            if($session->get('logged_in') == true) {
                //need always
                $session = session();
                $userModel = new UserModel();
                $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                $data['active'] = 'announcements';
        
                $annModel = new AnnouncementsModel();
                $data['announce'] =  $annModel->where('ann_id', $id)->first();
                return view('Modules\Announcements\Views\view', $data);
            }
            else {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
        }
    }

    public function add() {
        $validation =  \Config\Services::validation();
        $session = session();

        if($session->get('logged_in') != true) {
            session()->setFlashdata('msg', '404 error');
            return redirect()->to(base_url() . '/profile/' . $session->get('username'));
        }
        else {
            if($session->get('role') != 1) {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
            else {
                if(!empty($_POST)) {
                    //validation ng data
                    if ($validation->run($_POST, 'announcements') == false) {
                        $data['errors'] = \Config\Services::validation()->getErrors();
                        //need always
                        $session = session();
                        $userModel = new UserModel();
                        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                        $data['active'] = 'announcements';
                        return view('Modules\Announcements\Views\add', $data);
                    }
                    else {
                        $model = new AnnouncementsModel();
                        $file = $this->request->getFile('image');
                        $newName = $file->getRandomName();
                        $data = [
                        'title' => $this->request->getVar('title'),
                        'image' => $newName,
                        'description' => $this->request->getVar('description'),
                        'start_date' => $this->request->getVar('start_date'),
                        'end_date' => $this->request->getVar('end_date'),
                        'date_posted' => date('Y-m-d H:i:s')
                        ];
                        $file->move('../public/uploads/announcements', $newName);
                        $model->insert($data);
        
                        // email part
                        $email = \Config\Services::email();
                        $userModel = new UserModel();
                        $users = $userModel->findAll();
                        foreach ($users as $user) {
                            $email->clear();
                            $email->setTo($user['email']);
                            $email->setFrom('facultyea@gmail.com', 'Faculty and Employees Association');
                            $email->setSubject($data['title']);
                            $email->setMessage('Hi ' . $user['first_name'] . ' There\'s a new announcement from the association with the description of '. $data['description']);
                            if ($email->send()) {
                                // if successfully send
                                $session = session();
                                $session->setFlashdata('msg', 'Announcement added and sent to the association members !');
                                return redirect('announcements');
                            }
                            else {
                                // Email sending failed
                                $session = session();
                                $session->setFlashdata('failedmsg', 'Announcement added but not sent email notifications');
                                return redirect('announcements');
                            }
                        }
                    }
                }
                else {
                    //need always
                    $session = session();
                    $userModel = new UserModel();
                    $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                    $data['active'] = 'announcements';
        
                    //view palang ng site
                    return view('Modules\Announcements\Views\add', $data);
                }
            }
        }
    }

    public function delete($id=null) {
        $session = session();
        $userFilter = new userFilter();

        if($userFilter->isAdmin() == 'profile') {
            session()->setFlashdata('msg', '404 error');
            return redirect()->to(base_url() . '/profile/' . $session->get('username'));
        }
        else {
            if(!$userFilter->isAdmin()) {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
            else {
                $session = session();
                $annModel = new AnnouncementsModel();
                $annModel->delete($id);
                $session->setFlashdata('msg', 'Successfully deleted data');
                return redirect('announcements');
            }
        }
    }

    public function edit() {
        $session = session();
        $userFilter = new userFilter();

        if($userFilter->isAdmin() == 'profile') {
            session()->setFlashdata('msg', '404 error');
            return redirect()->to(base_url() . '/profile/' . $session->get('username'));
        }
        else {
            if(!$userFilter->isAdmin()) {
                session()->setFlashdata('msg', 'Please login to access this page.');
                return redirect()->to(base_url() . '/login');
            }
            else {
                $validation =  \Config\Services::validation();
                $model = new AnnouncementsModel();
                //validation ng data
                if ($validation->run($_POST, 'announcements') == false) {
                    $data['errors'] = \Config\Services::validation()->getErrors();
                    //need always
                    $session = session();
                    $userModel = new UserModel();
                    $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                    $data['active'] = 'announcements';
                    return view('Modules\Announcements\Views\add', $data);
                }
                else {
                    $model = new AnnouncementsModel();
                    $file = $this->request->getFile('image');
                    $newName = $file->getRandomName();
                    $data = [
                        'ann_id' => $_POST['ann_id'],
                        'title' => $this->request->getVar('title'),
                        'image' => $newName,
                        'description' => $this->request->getVar('description'),
                        'start_date' => $this->request->getVar('start_date'),
                        'end_date' => $this->request->getVar('end_date'),
                        'date_posted' => date('Y-m-d H:i:s')
                    ];
                    $file->move('../public/uploads/announcements', $newName);
                    $model->update($_POST['ann_id'],$data);
        
                    // email part
                    $email = \Config\Services::email();
                    $userModel = new UserModel();
                    $users = $userModel->findAll();
                    foreach ($users as $user) {
                        $email->clear();
                        $email->setTo($user['email']);
                        $email->setFrom('facultyea@gmail.com', 'Faculty and Employees Association');
                        $email->setSubject($data['title']);
                        $email->setMessage('Hi ' . $user['first_name'] . ' There\'s a new announcement from the association with the description of '. $data['description']);
                        if ($email->send()) {
                            // if successfully send
                            $session = session();
                            $session->setFlashdata('msg', 'Announcement edit and sent to the association members !');
                            return redirect('announcements');
                        }
                        else {
                            print_r($email->printDebugger());
                        }
                    }
                }
            }
        }        
    }
}