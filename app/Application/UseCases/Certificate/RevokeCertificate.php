<?php

namespace App\Application\UseCases\Certificate;

use App\Domain\Repositories\CertificateRepositoryInterface;

class RevokeCertificate
{
    public function __construct(
        private CertificateRepositoryInterface $repository
    ) {}

    public function execute(int $certificateId): void
    {
        $this->repository->delete($certificateId);
    }
}
