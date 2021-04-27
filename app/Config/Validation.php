<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

		public $announcements = [
		'title' => [
			'label'  => 'title',
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'You must have {field} provided',
				'alpha_numeric_space' => 'Title must include only alphanumeric characters or spaces.',
			]
		],

		'description' => [
			'label'  => 'description',
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'You must have {field} provided',
				'alpha_numeric_space' => 'Title must include only alphanumeric characters or spaces.',
			]
		],

		'start_date' => [
			'label'  => 'date start',
			'rules'  => 'required',
			'errors' => [
				'required' => 'You must have {field} provided'
			]
		],

		'end_date' => [
			'label'  => 'date end',
			'rules'  => 'required',
			'errors' => [
				'required' => 'You must have {field} provided'
			]
		],

		// images
		'image' => [
			'rules' => 'uploaded[image]|is_image[image]',
			'errors' => [
				'uploaded' => 'Please upload image.',
				'is_image' => 'Uploaded file is not a valid image.',
			]
		],
	];
}
