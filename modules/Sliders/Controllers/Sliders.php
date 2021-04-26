<?php namespace Modules\Sliders\Controllers;

use Modules\Users\Models\UserModel;
use Modules\Sliders\Models\SliderModel;
use CodeIgniter\Controller;
use App\Controllers\UserFilter;

class Sliders extends Controller
{
	public function index()
	{
        //need always
        $session = session();
        $userModel = new UserModel();
        $sliderModel = new SliderModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'sliders';

        $data['sliders'] = $sliderModel->findAll();
        return view('Modules\Sliders\Views\index', $data);
	}
	//--------------------------------------------------------------------
	public function add() {
        $validation =  \Config\Services::validation();
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
                if(!empty($_POST)) {
                    date_default_timezone_set('Asia/Manila');
                    $date = date('Y-m-d H:i:s');

                    helper(['form', 'url']);
                    $file = $this->request->getFile('image');
                    $fileName = $file->getRandomName();
                    $model = new SliderModel();
                    $data = [
                        'title' => $this->request->getVar('title'),
                        'description'  => $this->request->getVar('description'),
                        'image_file'  => $fileName,
                        'created_at' => $date
                    ];
                    if($model->save($data)) {
                        $file = $file->move('uploads/sliders', $fileName);
                        if($file) {
                            die('file uploaded');
                        }
                        else {
                            die('error moving file');
                        }
                    }
                    // mamaya na to XD
                    // $input = $this->validate([
                    //     'name' => 'required|min_length[3]',
                    //     'email' => 'required|valid_email',
                    //     'phone' => 'required|numeric|max_length[10]'
                    // ]);

                    // //validation ng data
                    // if ($validation->run($_POST, 'announcements') == false) {
                    //     $data['errors'] = \Config\Services::validation()->getErrors();
                    //     //need always
                    //     $session = session();
                    //     $userModel = new UserModel();
                    //     $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                    //     $data['active'] = 'announcements';
                    //     return view('Modules\Announcements\Views\add', $data);
                    // }
                    // else {

                    // }
                }
                else {
                    //need always
                    $session = session();
                    $userModel = new UserModel();
                    $data['logged_in'] = $userModel->viewProfile($session->get('username'));
                    $data['active'] = 'sliders';
        
                    //view palang ng site
                    return view('Modules\Sliders\Views\add', $data);
                }
            }
        }
	}
}
