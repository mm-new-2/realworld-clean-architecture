<?php

namespace App\UseCases\User;

class UserResponse {

	public string $email;
	public string $token;
	public string $username;
	public string $bio;
	public ?string $image;

	public function __construct(string $email, string $token, string $username, string $bio, ?string $image) {
		$this->email = $email;
		$this->token = $token;
		$this->username = $username;
		$this->bio = $bio;
		$this->image = $image;
	}
}
