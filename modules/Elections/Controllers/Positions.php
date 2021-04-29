<?php
namespace Modules\Elections\Controllers;

use App\Controllers\BaseController;
use Modules\Elections\Models\CandidateModel;
use Modules\Elections\Models\PositionsModel;
use Modules\Users\Models\UserModel;

class Positions extends BaseController {
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
		
		$data['positions'] = $positionsModel->findAll();

        $user = $userModel->where('username', $session->get('username'))
                          ->first();				  
        
        $data['logged_in'] = $user;
        $data['active'] = 'elections';
        $data['elections'] = 'positions';
		return view('Modules\Elections\Views\Positions\index', $data);
	}

	public function add() {
		$validation =  \Config\Services::validation();
		$session = session();
		$positionsModel = new PositionsModel();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());

		$positionCheck = $validation->setRules([
			'description' => 'required',
			'max_vote' => 'required|integer',
		]);

		if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'Please enter values');
			return redirect()->back();
		}
		else {
			$data = [
				'description' => $this->request->getVar('description'),
				'max_vote' => $this->request->getVar('max_vote'),
                'created_at' => $date,
			];
			
			if($positionsModel->addPosition($data)) {
				$session->setFlashdata('successMsg', 'Successfully added position');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add position, please try again');
				return redirect()->back();
			}
		}
	}    

    public function delete($id) {
		$session = session();
		$positionsModel = new PositionsModel();

        if($positionsModel->delete($id)) {
            $session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Position deleted successfully!');
            return redirect()->back();
        }
        else {
            $session->setFlashdata('failMsg', '<i class="fas fa-times-circle"></i> Position failed to delete!');
            return redirect()->back();
        }
    }
}