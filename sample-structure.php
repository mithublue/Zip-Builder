<?php
$processor_commands = array(
	'free' => array(
		'name' => 'neoForms',
		'slug' => 'neoforms',
		'change' => array(
			'neoforms.php' => array(
				'Plugin Name: neoForms' => 'Plugin Name: neoForms'
			)
		),
		'exclude' => array(
			'.git',
			'pro'
		)
	),
	'pro_basic' => array(
		'name' => 'neoForms Pro Basic',
		'slug' => 'neoforms-pro-basic',
		'change' => array(
			'neoforms.php' => array(
				'Plugin Name: neoForms' => 'Plugin Name: neoForms Pro Basic',
			),
			'readme.txt' => array(
				'=== neoForms ===' => '=== neoForms Pro Basic ===',
			)
		),
		'exclude' => array(
			'.git',
			'pro/.git',
			'pro/event-registration',
			'pro/rating-form',
			'pro/recommendation-form',
			'pro/support-form',
		)
	),
	'pro_plus' => array(
		'name' => 'neoForms Pro Plus',
		'slug' => 'neoforms-pro-plus',
		'change' => array(
			'neoforms.php' => array(
				'Plugin Name: neoForms' => 'Plugin Name: neoForms Pro Plus',
			),
			'readme.txt' => array(
				'=== neoForms ===' => '=== neoForms Pro Plus ===',
			)
		),
		'exclude' => array(
			'.git',
			'pro/.git',
			'pro/event-registration',
			'pro/rating-form'
		)
	),
	'pro_ultimate' => array(
		'name' => 'neoForms Pro Ultimate',
		'slug' => 'neoforms-pro-ultimate',
		'change' => array(
			'neoforms.php' => array(
				'Plugin Name: neoForms' => 'Plugin Name: neoForms Pro Ultimate',
			),
			'readme.txt' => array(
				'=== neoForms ===' => '=== neoForms Pro Ultimate ===',
			)
		),
		'exclude' => array(
			'.git',
			'pro/.git',
		)
	)
);