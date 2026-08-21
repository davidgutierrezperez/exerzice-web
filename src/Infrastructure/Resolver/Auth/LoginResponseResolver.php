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
        $data = $response['data'];

        if (!$data)
            return new ResolveResult(null, [LoginResolverError::DATA_REQUIRED]);

        error_log("DATA: " . print_r($data, true));

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