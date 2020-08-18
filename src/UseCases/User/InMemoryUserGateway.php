<?php

namespace App\UseCases\User;

use App\Domain\User\User;
use App\Gateway\User\UserGateway;

class InMemoryUserGateway implements UserGateway {

	/** @var User[] */
	public array $users;

	public function create(string $email, string $username, string $password): void {
		$user = new User($email, $username, $password, '', null);
		$this->users[$user->email] = $user;
	}

	public function get(string $email): User {
		return $this->users[$email];
	}
}
