<?php

namespace App\UseCases\User;

use App\Gateway\User\UserGateway;

class CreateUserUseCase {

	private UserGateway $user_gateway;

	public function __construct(UserGateway $user_gateway) {
		$this->user_gateway = $user_gateway;
	}

	public function create(CreateUserRequest $create_user_request): void {
		$this->user_gateway->create(
			$create_user_request->email,
			$create_user_request->username,
			$create_user_request->password
		);
	}
}
