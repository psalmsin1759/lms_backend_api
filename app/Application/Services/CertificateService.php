<?php

namespace App\Application\Services;

use App\Application\UseCases\Certificate\IssueCertificate;
use App\Application\UseCases\Certificate\GetUserCertificates;
use App\Application\UseCases\Certificate\ReissueCertificate;
use App\Application\UseCases\Certificate\RevokeCertificate;
use App\Application\UseCases\Certificate\VerifyCertificate;
use App\Domain\Entities\CertificateEntity;

class CertificateService
{
    public function __construct(
        private IssueCertificate $issueCertificate,
        private GetUserCertificates $getUserCertificates,
        private ReissueCertificate $reissueCertificate,
        private RevokeCertificate $revokeCertificate,
        private VerifyCertificate $verifyCertificate
    ) {}

    
    public function issue(int $userId, int $courseId): CertificateEntity
    {
        return $this->issueCertificate->execute($userId, $courseId);
    }

    public function getUserCertificates(int $userId)
    {
        return $this->getUserCertificates->execute($userId);
    }

    public function reissue(int $certificateId)
    {
        return $this->reissueCertificate->execute($certificateId);
    }   

    public function revoke(int $certificateId): void
    {
        $this->revokeCertificate->execute($certificateId);
    }

    public function verify(string $certificateNumber): bool
    {
        return $this->verifyCertificate->execute($certificateNumber);
    }
}
