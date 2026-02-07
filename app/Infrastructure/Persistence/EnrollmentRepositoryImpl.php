<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Enrollment as EnrollmentEntity;
use App\Domain\Repositories\EnrollmentRepositoryInterface;
use App\Models\Enrollment as EnrollmentModel;
use App\Enums\CompletionStatus;
use App\Exceptions\ApiException;

class EnrollmentRepositoryImpl implements EnrollmentRepositoryInterface
{
    public function create(EnrollmentEntity $enrollment): EnrollmentEntity
    {
        $model = EnrollmentModel::create([
            'user_id' => $enrollment->userId,
            'course_id' => $enrollment->courseId,
            'enrolled_at' => $enrollment->enrolledAt,
            'completion_status' => $enrollment->completionStatus->value,
            'completion_date' => $enrollment->completionDate,
        ]);

        return $this->toEntity($model);
    }

    public function update(EnrollmentEntity $enrollment): EnrollmentEntity
    {
        $model = EnrollmentModel::find($enrollment->id);
        if (!$model) throw new ApiException('Enrollment not found');

        $model->update([
            'completion_status' => $enrollment->completionStatus->value,
            'completion_date' => $enrollment->completionDate,
        ]);

        return $this->toEntity($model);
    }

    public function delete(int $id): void
    {
        $model = EnrollmentModel::find($id);
        if (!$model) throw new ApiException('Enrollment not found');

        $model->delete();
    }

    public function findById(int $id): ?EnrollmentEntity
    {
        $model = EnrollmentModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findByUserAndCourse(int $userId, int $courseId): ?EnrollmentEntity
    {
        $model = EnrollmentModel::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        return $model ? $this->toEntity($model) : null;
    }

    public function getByUser(int $userId): array
    {
        return EnrollmentModel::where('user_id', $userId)
            ->get()
            ->map(fn($m) => $this->toEntity($m))
            ->toArray();
    }

    public function getByCourse(int $courseId): array
    {
        return EnrollmentModel::where('course_id', $courseId)
            ->get()
            ->map(fn($m) => $this->toEntity($m))
            ->toArray();
    }

    private function toEntity(EnrollmentModel $model): EnrollmentEntity
    {
        return new EnrollmentEntity(
            id: $model->id,
            userId: $model->user_id,
            courseId: $model->course_id,
            enrolledAt: $model->enrolled_at,
            completionStatus: CompletionStatus::from($model->completion_status),
            completionDate: $model->completion_date
        );
    }
}
