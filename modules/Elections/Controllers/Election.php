<?php
namespace Modules\Elections\Controllers;

use App\Controllers\BaseController;
use Modules\Elections\Models\CandidateModel;
use Modules\Elections\Models\PositionsModel;
use Modules\Elections\Models\VoteModel;
use Modules\Users\Models\UserModel;

class Election extends BaseController {
	public function index() {
		helper(['form', 'url']);
		$session = session();
		$candidateModel = new CandidateModel();
		$positionsModel = new PositionsModel();
		$userModel = new UserModel();
		$voteModel = new VoteModel();

		$checkVoter = $voteModel->checkVote($session->get('user_id'));
		if(!empty($checkVoter)) {
			$user = $userModel->where('username', $session->get('username'))
			->first();				  
	
			$data['logged_in'] = $user;
			$data['active'] = 'elections';
			$data['elections'] = 'voting';
			$session->setFlashdata('failMsg', 'Currently voted, please wait for the election results');
			return view('Modules\Elections\Views\Election\voted', $data);
		}

		$data['candidates'] = $candidateModel->viewCandidates();
		$data['positions'] = $positionsModel->findAll();
		// echo '<pre>';
		// print_r($data['candidates']);
		// echo '</pre>';
		// die();
		$user = $userModel->where('username', $session->get('username'))
		->first();				  

		$data['logged_in'] = $user;
		$data['active'] = 'elections';
		$data['elections'] = 'voting';
		return view('Modules\Elections\Views\Election\voting', $data);
	}

	public function castVote() {
		$session = session();
		$voteModel = new VoteModel();
		$positionsModel = new PositionsModel();
		$positions = $positionsModel->findAll();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());
		
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		$data['positions'] = $positionsModel->findAll();
		foreach($data['positions'] as $position) {
			$data = [
				'position_id' => $position['id'],
				'candidate_id' => $this->request->getVar($position['id']),
				'voters_id' => $session->get('user_id'),
			];
			if($voteModel->insert($data)) {
				continue;
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to cast vote, please try again');
				return redirect()->back();
			}
		}
		$session->setFlashdata('successMsg', 'Successfully casted vote');
		return redirect()->back();
	}
}