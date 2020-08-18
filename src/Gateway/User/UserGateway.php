<?php

namespace App\Gateway\User;

use App\Domain\User\User;

interface UserGateway {

	public function create(string $email, string $username, string $password): void;
	public function get(string $email): User;
}
