<?php

namespace App\UseCases\User;

use App\Domain\User\User;
use App\Gateway\Exception\UserNotFoundException;
use App\Gateway\User\UserGateway;
use App\UseCases\User\Exceptions\UserAuthenticationException;
use App\UseCases\User\Requests\AuthenticateUserRequest;

class AuthenticateUserUseCase {

	private UserGateway $user_gateway;

	public function __construct(UserGateway $user_gateway) {
		$this->user_gateway = $user_gateway;
	}

	public function execute(AuthenticateUserRequest $authenticate_user_request): UserResponse {
		try {
			$user = $this->user_gateway->get(
				$authenticate_user_request->email,
			);
		} catch (UserNotFoundException $exception) {
			throw new UserAuthenticationException("Fail to authenticate user {$authenticate_user_request->email}", 0, $exception);
		}

		if (!$this->isPasswordValid($authenticate_user_request, $user)) {
			throw new UserAuthenticationException("Fail to authenticate user {$authenticate_user_request->email}");
		}

		return $this->createUserResponse($user);
	}

	private function isPasswordValid(AuthenticateUserRequest $authenticate_user_request, User $user): bool {
		return $authenticate_user_request->password == $user->password;
	}

	private function createUserResponse(User $user): UserResponse {
		return new UserResponse(
			$user->email,
			$this->getToken(),
			$user->username,
			$user->bio,
			$user->image,
		);
	}

	private function getToken(): string {
		return '';
	}
}
