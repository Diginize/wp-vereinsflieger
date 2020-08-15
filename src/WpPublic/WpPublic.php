<?php


namespace Diginize\WpVereinsflieger\WpPublic;


class WpPublic {

	/** @var Authentication */
	private $authentication;

	/** @var Profile */
	private $profile;

	public function __construct() {
		$this->setupDependencies();
		$this->setupHooks();
	}

	private function setupDependencies(): void {
		$this->authentication = new Authentication();
		//$this->profile = new Profile();
	}

	private function setupHooks(): void {
		add_filter('authenticate', [$this->authentication, 'authenticationRequest'], 50, 3);
		add_action('lostpassword_post', [$this->authentication, 'lostPasswordRequest'], 50, 2);
		// TODO: filter user and password changes for vereinsflieger.de users
	}

	private static $public = null;
	public static function init(): self {
		if (!self::$public) {
			self::$public = new self();
		}

		return self::$public;
	}

}