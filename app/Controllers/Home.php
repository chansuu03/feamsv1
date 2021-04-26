<?php

namespace App\Controllers;
use Modules\Announcements\Models\AnnouncementsModel;
use Modules\Sliders\Models\SliderModel;

class Home extends BaseController
{
	public function index() {
    	$session = session();
		$data['isLoggedIn'] = $session->get('logged_in');
		$data['role'] = $session->get('role');
		$data['username'] = $session->get('username');

		$announceModel = new AnnouncementsModel();
		$sliderModel = new SliderModel();
		$data['announcements'] = $announceModel->view();
		$data['sliders'] = $sliderModel->view();
		return view('home',$data);
	}
}
