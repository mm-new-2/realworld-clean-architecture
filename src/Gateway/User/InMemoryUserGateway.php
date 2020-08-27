<?php

namespace App\Gateway\User;

use App\Domain\User\User;
use App\Gateway\Exception\UserNotFoundException;

class InMemoryUserGateway implements UserGateway {

	/** @var User[] */
	public array $users;

	public function create(string $email, string $username, string $password): void {
		$user = new User($email, $username, $password, '', null);
		$this->users[$user->email] = $user;
	}

	public function get(string $email): User {
		if (!isset($this->users[$email])) {
			throw new UserNotFoundException("User not found for email {$email}");
		}

		return $this->users[$email];
	}
}
