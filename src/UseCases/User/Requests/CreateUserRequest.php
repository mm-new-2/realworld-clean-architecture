<?php

namespace App\UseCases\User\Requests;

class CreateUserRequest {

	public string $username;
	public string $email;
	public string $password;

	public function __construct(string $username, string $email, string $password) {
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}
}
