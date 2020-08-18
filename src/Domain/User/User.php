<?php

namespace App\Domain\User;

class User {

	public string $email;
	public string $username;
	public string $password;
	public string $bio;
	public ?string $image;

	public function __construct(string $email, string $username, string $password, string $bio, ?string $image) {
		$this->email = $email;
		$this->username = $username;
		$this->password = $password;
		$this->bio = $bio;
		$this->image = $image;
	}

}
