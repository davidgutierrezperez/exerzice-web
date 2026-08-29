<?php 

namespace Infrastructure\Resolver\Auth;

use Application\Security\Auth\UserEntity;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Resolver\ResolveResult;
use Infrastructure\Resolver\ResponseResolver;
use Override;
use Ramsey\Uuid\Uuid;

/**
 * The class LoginResponseResolver represents a specific response resolver for HTTP logging responses.
 */
final class LoginResponseResolver extends ResponseResolver {

    #[Override]
    /**
     * Resolves a logging HTTP response.
     * @param mixed $response HTTP response to resolve.
     * @return ResolveResult Result of the resolving process.
     */
    public function resolve(HttpResponse $response): ResolveResult {
        $responseData = $response->getValue();
        $errors = $responseData['errors'] ?? [];
        $data = $responseData['data'] ?? [];

        if($errors)
            return $this->resolveErrors(LoginResolverError::class, $errors);

        return $this->resolveData($data);
    }

    /**
     * Resolves the data of the response.
     * @param array $data Response's data.
     * @return ResolveResult Result of the resolving process.
     */
    private function resolveData(array $data): ResolveResult {
        if (!$data)
            return new ResolveResult(null, [LoginResolverError::DATA_REQUIRED]);

        $userId = $data['id'] ?? null;
        $userName = $data['full_name'] ?? null;
        $avatarUrl = $data['avatar_url'] ?? null;
        $verificationStatus = $data['verified'] ?? null;

        $errors = [];

        if (!$userId)
            $errors[] = LoginResolverError::USER_ID_REQUIRED;

        if ($userId && !Uuid::isValid($userId))
            $errors[] = LoginResolverError::USER_ID_INVALID;

        if (!$userName)
            $errors[] = LoginResolverError::USER_NAME_REQUIRED;

        if ($verificationStatus === null)
            $errors[] = LoginResolverError::USER_VERIFICATION_STATUS_REQUIRED;

        if (!empty($errors))
            new ResolveResult(null, $errors);

        $normalizedUserId = Uuid::fromString($userId);
        $userVerified = ($verificationStatus != 0);

        $userEntity = new UserEntity($normalizedUserId, $userName, $avatarUrl, $userVerified);

        return new ResolveResult($userEntity, []);
    } 
}