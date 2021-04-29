<?php
namespace Modules\Elections\Controllers;

use App\Controllers\BaseController;
use Modules\Elections\Models\CandidateModel;
use Modules\Elections\Models\PositionsModel;
use Modules\Users\Models\UserModel;

class Candidates extends BaseController {
	public function index() {
		helper('form', 'url');
		$session = session();
		$candidateModel = new CandidateModel();
		$userModel = new UserModel();
		$positionsModel = new PositionsModel();

        if($session->get('logged_in') != true) {
			session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(site_url());
        }
		
		$data['candidates'] = $candidateModel->viewCandidates();
		$data['users'] = $userModel->findAll();
		$data['positions'] = $positionsModel->findAll();
		
		// echo '<pre>';
		// print_r($data['candidates']);
		// echo '</pre>';
		// die();
        $user = $userModel->where('username', $session->get('username'))
                          ->first();				  
        
        $data['logged_in'] = $user;
        $data['active'] = 'elections';
        $data['elections'] = 'candidates';
		return view('Modules\Elections\Views\Candidates\index', $data);
	}

	public function add() {
		$validation =  \Config\Services::validation();
		$session = session();
		$candidateModel = new CandidateModel();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());

		$candidateCheck = $validation->setRules([
			'candidate_name' => 'required',
			'position' => 'required',
			'platform' => 'required',
		]);

		if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'Please enter values');
			return redirect()->back();
		}
		else {
			$data = [
				'position_id' => $this->request->getVar('position'),
				'user_id' => $this->request->getVar('candidate_name'),
				'platform' => $this->request->getVar('platform'),
				'created_at' => date('Y-m-d H:i:s', time())
			];

			if($candidateModel->insertData($data)) {
				$session->setFlashdata('successMsg', 'Successfully added candidate');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add candidate, please try again');
				return redirect()->back();
			}
		}
	}

    public function delete($id) {
		$session = session();
		$candidateModel = new CandidateModel();

        if($candidateModel->delete($id)) {
            $session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Candidate deleted successfully!');
            return redirect()->back();
        }
        else {
            $session->setFlashdata('failMsg', '<i class="fas fa-times-circle"></i> Candidate failed to delete!');
            return redirect()->back();
        }
    }
}