<?php


namespace UseCases\User;


use App\Gateway\User\InMemoryUserGateway;
use App\UseCases\User\AuthenticateUserUseCase;
use App\UseCases\User\CreateUserUseCase;
use App\UseCases\User\Exceptions\UserAuthenticationException;
use App\UseCases\User\Requests\AuthenticateUserRequest;
use App\UseCases\User\Requests\CreateUserRequest;
use App\UseCases\User\UserResponse;
use PHPUnit\Framework\TestCase;

class AuthenticateUserUseCaseTest extends TestCase {

	private const USERNAME = "user";
	private const EMAIL = "email@email.com";
	private const PASSWORD = "password";

	public function testAuthenticateUser(): void {
		$user_gateway = new InMemoryUserGateway();
		$this->createUser($user_gateway);

		$authenticate_user_case = new AuthenticateUserUseCase($user_gateway);
		$user_response = $authenticate_user_case->execute(
			new AuthenticateUserRequest(self::EMAIL,self::PASSWORD)
		);

		$this->assertEquals($this->getExpectedUserReponse(), $user_response);
	}

	public function testAuthenticateUserWithWrongPassword_ShouldThrowUserAuthenticationException(): void {
		$user_gateway = new InMemoryUserGateway();
		$this->createUser($user_gateway);

		$authenticate_user_case = new AuthenticateUserUseCase($user_gateway);
		$wrong_password = self::PASSWORD . 'wrong';
		$authentication_email = self::EMAIL;
		$this->expectException(UserAuthenticationException::class);
		$this->expectExceptionMessage("Fail to authenticate user {$authentication_email}");
		$authenticate_user_case->execute(
			new AuthenticateUserRequest($authentication_email, $wrong_password)
		);
	}

	public function testAuthenticateUserWithNonexistentUser_ShouldThrowUserAuthenticationException(): void {
		$user_gateway = new InMemoryUserGateway();
		$this->createUser($user_gateway);

		$authenticate_user_case = new AuthenticateUserUseCase($user_gateway);
		$wrong_password = self::PASSWORD;
		$authentication_email = self::EMAIL . 'wrong';
		$this->expectException(UserAuthenticationException::class);
		$this->expectExceptionMessage("Fail to authenticate user {$authentication_email}");
		$authenticate_user_case->execute(
			new AuthenticateUserRequest($authentication_email, $wrong_password)
		);
	}

	private function createUser(InMemoryUserGateway $user_gateway): void {
		$create_user_case = new CreateUserUseCase($user_gateway);
		$create_user_case->create(
			new CreateUserRequest(
				self::USERNAME,
				self::EMAIL,
				self::PASSWORD
			)
		);
	}

	private function getExpectedUserReponse(): UserResponse {
		return new UserResponse(
			self::EMAIL,
			$token = '',
			self::USERNAME,
			$bio = '',
			$image = null,
		);
	}

}
