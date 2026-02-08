<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CertificateEntity;
use Illuminate\Support\Collection;

interface CertificateRepositoryInterface
{
   
    public function create(CertificateEntity $entity): CertificateEntity;

   
    public function update(CertificateEntity $entity): CertificateEntity;


    public function delete(int $id): void;

 
    public function findById(int $id): ?CertificateEntity;

 
    public function findByUserAndCourse(int $userId, int $courseId): ?CertificateEntity;

  
    public function getUserCertificates(int $userId): Collection;

    public function getCourseCertificates(int $courseId): Collection;

    public function existsByNumber(string $certificateNumber): bool;
}
