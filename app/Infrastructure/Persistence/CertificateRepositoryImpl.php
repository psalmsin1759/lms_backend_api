<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\CertificateEntity;
use App\Domain\Repositories\CertificateRepositoryInterface;
use App\Models\Certificate;
use Illuminate\Support\Collection;
use RuntimeException;

class CertificateRepositoryImpl implements CertificateRepositoryInterface
{
    public function create(CertificateEntity $entity): CertificateEntity
    {
        $model = Certificate::create([
            'user_id' => $entity->userId,
            'course_id' => $entity->courseId,
            'certificate_number' => $entity->certificateNumber,
            'issued_at' => $entity->issuedAt,
            'created_at' => $entity->createdAt,
            'updated_at' => $entity->updatedAt
        ]);

        return $this->toEntity($model);
    }

    public function update(CertificateEntity $entity): CertificateEntity
    {
        $model = Certificate::find($entity->id);
        if (!$model) {
            throw new RuntimeException('Certificate not found');
        }

        $model->update([
            'certificate_number' => $entity->certificateNumber,
            'issued_at' => $entity->issuedAt
        ]);

        return $this->toEntity($model);
    }

    public function delete(int $id): void
    {
        $model = Certificate::find($id);
        if (!$model) {
            throw new RuntimeException('Certificate not found');
        }

        $model->delete();
    }

    public function findById(int $id): ?CertificateEntity
    {
        $model = Certificate::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findByUserAndCourse(int $userId, int $courseId): ?CertificateEntity
    {
        $model = Certificate::where('user_id', $userId)
                            ->where('course_id', $courseId)
                            ->first();
        return $model ? $this->toEntity($model) : null;
    }

    public function getUserCertificates(int $userId): Collection
    {
        $models = Certificate::where('user_id', $userId)->get();
        return $models->map(fn($model) => $this->toEntity($model));
    }

    public function getCourseCertificates(int $courseId): Collection
    {
        $models = Certificate::where('course_id', $courseId)->get();
        return $models->map(fn($model) => $this->toEntity($model));
    }

    public function existsByNumber(string $certificateNumber): bool
    {
        return Certificate::where('certificate_number', $certificateNumber)->exists();
    }

    /** Convert Eloquent model to Domain Entity */
    private function toEntity(Certificate $model): CertificateEntity
    {
        return new CertificateEntity(
            id: $model->id,
            userId: $model->user_id,
            courseId: $model->course_id,
            certificateNumber: $model->certificate_number,
            issuedAt: $model->issued_at,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at
        );
    }
}
