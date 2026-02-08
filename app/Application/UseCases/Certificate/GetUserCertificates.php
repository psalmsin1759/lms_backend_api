<?php

namespace App\Application\UseCases\Certificate;

use App\Domain\Repositories\CertificateRepositoryInterface;

class GetUserCertificates
{
    public function __construct(
        private CertificateRepositoryInterface $repository
    ) {}

    public function execute(int $userId): array
    {
        return $this->repository->getUserCertificates($userId)->toArray();
    }
}
