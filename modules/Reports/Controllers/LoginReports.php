<?php
namespace Modules\Reports\Controllers;

use App\Controllers\BaseController;
use Modules\Users\Models\LoginModel;
use Modules\Users\Models\UserModel;
use App\Libraries\Pdf;
use App\Libraries\PDF_HTML;

class LoginReports extends BaseController {
	public function index() {
        $session = session();
        if($session->get('logged_in') != true)
        {
            return redirect()->to(site_url());
        }
		
        $userModel = new UserModel();
		$loginModel = new LoginModel();

        $user = $userModel->where('username', $session->get('username'))
                          ->first();
		$data['details'] = $loginModel->print();						  
        
        $data['logged_in'] = $user;
        $data['active'] = 'reports';
        $data['reports'] = 'login';
		return view('Modules\Reports\Views\login', $data);
	}

    public function print() {
		$model = new LoginModel();
		$pdf = new Pdf(); 

		$pdf->AliasNbPages();
		$details = $model->print();
		
		$pdf->AddPage('l', 'Legal');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(70,10,'Login Reports');
		$pdf->Ln();

		$pdf->SetFont('Arial', 'B' ,8);
		$pdf->SetX(55);
		$pdf->Cell(50,10,'First Name',1);
		$pdf->Cell(50,10,'Last Name',1);
		$pdf->Cell(50,10,'Username',1);
		$pdf->Cell(30,10,'Role',1);
		$pdf->Cell(60,10,'Login Date',1);
		$pdf->Ln();
		foreach($details as $detail) {
			$pdf->SetX(55);
			$pdf->SetFont('Arial', '' ,8);
			$date = date_create($detail['login_date']);
			$datelogged = date_format($date, 'F d, Y H:i:s');

			$pdf->Cell(50,8,$detail['first_name'],1);
			$pdf->Cell(50,8,$detail['last_name'],1);
			$pdf->Cell(50,8,$detail['username'],1);
			$pdf->Cell(30,8,$detail['role_id'],1);
			$pdf->Cell(60,8,$datelogged,1);
			$pdf->Ln();
		}
		date_default_timezone_set('Asia/Manila');
		$date = date('F d,Y', time());
        $this->response->setHeader('Content-Type', 'application/pdf');
		$pdf->Output('D', 'Login Report ['.$date.'].pdf'); 
    }
}