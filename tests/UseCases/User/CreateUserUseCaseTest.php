<?php

namespace UseCases\User;

use App\Domain\User\User;
use App\UseCases\User\CreateUserRequest;
use App\UseCases\User\CreateUserUseCase;
use App\UseCases\User\InMemoryUserGateway;
use App\UseCases\User\UserResponse;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase {

	public function testCreateUser(): void {
		$user_gateway = new InMemoryUserGateway();
		$use_case = new CreateUserUseCase($user_gateway);
		$use_case->create(
			new CreateUserRequest(
				$username = "user",
				$email = "email@email.com",
				$password = "password"
			)
		);
		Assert::assertEquals(
			new User(
				$email,
				$username,
				$password,
				$bio = '',
				$image = null
			),
			$user_gateway->get($email)
		);
	}
}
