<?php

namespace App\Application\UseCases\Certificate;

use App\Domain\Entities\CertificateEntity;
use App\Domain\Repositories\CertificateRepositoryInterface;
use App\Exceptions\ApiException;
use Illuminate\Support\Str;

class ReissueCertificate
{
    public function __construct(
        private CertificateRepositoryInterface $repository
    ) {}

    public function execute(int $certificateId)
    {
        $certificate = $this->repository->findById($certificateId);
        if (!$certificate) {
            throw new ApiException('Certificate not found');
        }
        $updatedCertificate = new CertificateEntity(
            certificateNumber: strtoupper(Str::uuid()),
            issuedAt: now(),
            createdAt: $certificate->createdAt,
            updatedAt: now(),
            id: $certificate->id,
            userId: $certificate->userId,
            courseId: $certificate->courseId
        );

        return $this->repository->update($updatedCertificate);
    }
}
