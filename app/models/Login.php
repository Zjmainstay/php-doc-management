<?php
class LoginModel extends ModelAbstract {
	private function getSession() {
		$expire = 30 * 86400;
		session_set_cookie_params ( $expire );
		session_cache_expire ( $expire );
		return Utility_Session2::getInstance ( __METHOD__ );
	}
	function checkLogin() {
		return 'yes' === $this->getSession ()->get ( 'isLogin' );
	}
	function login($username, $password) {
		if ($this->checkLogin ()) {
			return true;
		}
		if (! empty ( $username )) {
			$usernameValid = 'admin';
			$passwordValid = 'admin';
			if ($username == $usernameValid && $password == $passwordValid) {
				$this->getSession ()->set ( 'isLogin', 'yes' );
				return true;
			}
		}
		return false;
	}
	function logout() {
		return $this->getSession ()->del ( 'isLogin' );
	}
}