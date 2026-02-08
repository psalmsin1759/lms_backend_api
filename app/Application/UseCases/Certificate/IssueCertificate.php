<?php

namespace App\Application\UseCases\Certificate;

use App\Domain\Entities\CertificateEntity;
use App\Domain\Repositories\CertificateRepositoryInterface;
use App\Exceptions\ApiException;
use Illuminate\Support\Str;

class IssueCertificate
{
    public function __construct(
        private CertificateRepositoryInterface $repository
    ) {}

    public function execute(int $userId, int $courseId): CertificateEntity
    {
        if ($this->repository->findByUserAndCourse($userId, $courseId)) {
            throw new ApiException('Certificate already issued.');
        }

        $certificate = new CertificateEntity(
            id: null,
            userId: $userId,
            courseId: $courseId,
            certificateNumber: strtoupper(Str::uuid()),
            issuedAt: now(),
            createdAt: now(),
            updatedAt: now()
        );

        return $this->repository->create($certificate);
    }
}
