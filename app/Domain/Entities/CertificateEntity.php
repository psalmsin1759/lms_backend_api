<?php

namespace App\Domain\Entities;

class CertificateEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $courseId,
        public readonly int $userId,
        public readonly string $certificateNumber,
        public readonly string $issuedAt,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null
    ) {}
}
