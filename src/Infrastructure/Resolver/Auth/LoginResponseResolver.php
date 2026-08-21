<?php 

namespace Infrastructure\Resolver\Auth;

use Application\Security\Auth\UserEntity;
use Infrastructure\Resolver\ResolveResult;
use Infrastructure\Resolver\ResponseResolver;
use Override;
use Ramsey\Uuid\Uuid;

final class LoginResponseResolver implements ResponseResolver {

    #[Override]
    public function resolve(mixed $response): ResolveResult {
        $errors = $response['errors'] ?? [];
        $data = $response['data'] ?? [];

        if($errors)
            return $this->resolveErrors($errors);

        return $this->resolveData($data);
    }

    private function resolveErrors(array $errors): ResolveResult {
        $normalizedErrors = [];

        foreach (LoginResolverError::cases() as $error) {
            if (in_array($error->value, $errors, true)) 
                $normalizedErrors[] = $error;
        }

        return new ResolveResult(null, $normalizedErrors);
    }

    private function resolveData(array $data): ResolveResult {
        if (!$data)
            return new ResolveResult(null, [LoginResolverError::DATA_REQUIRED]);

        $userId = $data['id'] ?? null;
        $userName = $data['full_name'] ?? null;

        $errors = [];

        if (!$userId)
            $errors[] = LoginResolverError::USER_ID_REQUIRED;

        if ($userId && !Uuid::isValid($userId))
            $errors[] = LoginResolverError::USER_ID_INVALID;

        if (!$userName)
            $errors[] = LoginResolverError::USER_NAME_REQUIRED;

        if (!empty($errors))
            new ResolveResult(null, $errors);

        $normalizedUserId = Uuid::fromString($userId);
        $userEntity = new UserEntity($normalizedUserId, $userName);

        return new ResolveResult($userEntity, []);
    } 
}