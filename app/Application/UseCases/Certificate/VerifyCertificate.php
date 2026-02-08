<?php

namespace App\Application\UseCases\Certificate;

use App\Domain\Repositories\CertificateRepositoryInterface;

class VerifyCertificate
{
    public function __construct(
        private CertificateRepositoryInterface $repository
    ) {}

    public function execute(string $certificateNumber): bool
    {
        return $this->repository->existsByNumber($certificateNumber);
    }
}
