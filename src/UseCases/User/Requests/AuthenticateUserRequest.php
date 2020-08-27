<?php

namespace App\UseCases\User\Requests;

class AuthenticateUserRequest {

	public string $email;
	public string $password;

	public function __construct(string $email, string $password) {
		$this->email = $email;
		$this->password = $password;
	}
}
