<?php
namespace Modules\Files\Controllers;

use CodeIgniter\Controller;
use Modules\Users\Models\UserModel;
use Modules\Files\Models\FileModel;
use CodeIgniter\HTTP\IncomingRequest;
use App\Controllers\UserFilter;

class Files extends \CodeIgniter\Controller
{
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
        helper('filesystem');
    }

    public function index() {
        //need always
        $session = session();
        $userModel = new UserModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'files';

        // dapat separate yung admin pati mga user na files
        $fileModel = new FileModel();
        $data['files'] = $fileModel->where('uploader', 'admin')->findAll();
        $data['members'] = $fileModel->where('uploader !=', 'admin')->findAll();
        return view('Modules\Files\Views\index', $data);
    }

    public function add() {
        helper(['form', 'url']);
        $request = service('request');

        $session = session();
        $userModel = new UserModel();
        $fileModel = new FileModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));

        if(empty($_POST)) {
            //need always
            $data['active'] = 'files';

            return view('Modules\Files\Views\add', $data);
        }
        else {
            $upload = $this->request->getFile('assocFile');
            $data = [
                'name' => $request->getPost('title'),
                'uploader' => $data['logged_in']['employee_id'],
                'name' =>  $request->getPost('title').'.'.$upload->guessExtension(),
                'size' =>  $upload->getSize(),
                'extension'  => $upload->guessExtension(),
                'uploaded_at' => date('Y-m-d H:i:s')
            ];
            $upload->move('uploads/files/assoc', $data['name']);
            $fileModel->insert($data);
        }
    }

    public function member($username = NULL) {
        $userFilter = new userFilter();

        if($userFilter->isLoggedIn()) {
            //need always
            $session = session();
            $userModel = new UserModel();
            $data['logged_in'] = $userModel->viewProfile($session->get('username'));
            $data['active'] = 'files';
    
            $fileModel = new FileModel();
            $data['files'] = $fileModel->where('uploader', 'admin')->findAll();
            $data['members'] = $fileModel->where('uploader', $session->get('username'))->findAll();
            return view('Modules\Files\Views\index', $data);
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    }

    public function memberAdd($username = null) {
        helper(['form', 'url']);
        $request = service('request');

        $session = session();
        $userModel = new UserModel();
        $fileModel = new FileModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $userFilter = new userFilter();

        if($userFilter->isLoggedIn()) {
            if(empty($_POST)) {
                //need always
                $data['active'] = 'files';
    
                return view('Modules\Files\Views\add', $data);
            }
            else {
                $upload = $this->request->getFile('assocFile');
                $data = [
                    'name' => $request->getPost('title'),
                    'uploader' => $data['logged_in']['employee_id'],
                    'name' =>  $request->getPost('title').'.'.$upload->guessExtension(),
                    'size' =>  $upload->getSize(),
                    'extension'  => $upload->guessExtension(),
                    'uploaded_at' => date('Y-m-d H:i:s')
                ];
                $upload->move('uploads/files/assoc', $data['name']);
                $fileModel->insert($data);
                // if successfully send
                $session = session();
                $session->setFlashdata('msg', 'File uploaded! Wait for the officer review');
                return redirect()->to(route_to('\Modules\Files\Controllers\Files::member/$1', $username)); 
            }
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    } 
    
    public function delete($username = null, $id = null)
    {
        $userFilter = new userFilter();

        if($userFilter->isLoggedIn()) {
            $session = session();
            $fileModel = new FileModel();
            if($fileModel->find($id)) {
                $fileModel->delFile($id);
                $session->setFlashdata('msg', 'Sucessfully deleted data');
                return redirect()->back(); 
            }
            else {
                $session->setFlashdata('msg', 'Failed to delete data');
                return redirect()->back(); 
            }
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    }
}