<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Models\Course as CourseModel;
use App\Enums\CourseStatus;
use App\Enums\CourseLevel;
use RuntimeException;

class CourseRepositoryImpl implements CourseRepositoryInterface
{
    public function create(Course $course): Course
    {
        $model = CourseModel::create([
            'instructor_id' => $course->instructorId,
            'title'         => $course->title,
            'description'   => $course->description,
            'slug'          => $course->slug,
            'level'         => $course->level->value,
            'duration'      => $course->duration,
            'price'         => $course->price,
            'status'        => $course->status->value,
        ]);

        return $this->toEntity($model);
    }

    public function update(Course $course): Course
    {
        $model = CourseModel::find($course->id);
        if (!$model) {
            throw new RuntimeException('Course not found');
        }

        $model->update([
            'title'       => $course->title,
            'description' => $course->description,
            'slug'        => $course->slug,
            'level'       => $course->level->value,
            'duration'    => $course->duration,
            'price'       => $course->price,
            'status'      => $course->status->value,
        ]);

        return $this->toEntity($model);
    }

    public function delete(int $id): void
    {
        $model = CourseModel::find($id);
        if (!$model) {
            throw new RuntimeException('Course not found');
        }
        $model->delete();
    }

    public function findById(int $id): ?Course
    {
        $model = CourseModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findBySlug(string $slug): ?Course
    {
        $model = CourseModel::where('slug', $slug)->first();
        return $model ? $this->toEntity($model) : null;
    }

    public function findByTitle(string $title): ?Course
    {
        $model = CourseModel::where('title', $title)->first();
        return $model ? $this->toEntity($model) : null;
    }

    public function all(): array
    {
        return CourseModel::all()
            ->map(fn ($model) => $this->toEntity($model))
            ->toArray();
    }

    public function getByInstructor(int $instructorId): array
    {
        return CourseModel::where('instructor_id', $instructorId)
            ->get()
            ->map(fn ($model) => $this->toEntity($model))
            ->toArray();
    }

   

    public function changeStatus(int $id, CourseStatus $status): Course
    {
        $model = CourseModel::find($id);
        if (!$model) {
            throw new RuntimeException('Course not found');
        }

        $model->update([
            'status' => $status->value,
        ]);

        return $this->toEntity($model);
    }

   

   public function paginate(
        int $perPage = 15,
        int $page = 1,
        ?string $search = null,
        ?string $status = null,
        ?string $level = null,
        ?int $instructorId = null,
        string $orderBy = 'created_at',
        string $orderDir = 'desc'
    ): array {
        $query = CourseModel::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($level) {
            $query->where('level', $level);
        }

        if ($instructorId) {
            $query->where('instructor_id', $instructorId);
        }

        // ✅ Whitelist sortable fields
        $allowedOrderBy = [
            'created_at',
            'title',
            'price',
            'duration',
        ];

        if (!in_array($orderBy, $allowedOrderBy, true)) {
            $orderBy = 'created_at';
        }

        $orderDir = strtolower($orderDir) === 'asc' ? 'asc' : 'desc';

        $paginator = $query
            ->orderBy($orderBy, $orderDir)
            ->paginate($perPage, ['*'], 'page', $page);

        return [
            

            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
                'data' => $paginator->getCollection()
                ->map(fn ($model) => $this->toEntity($model))
                ->toArray(),
            ],
        ];
    }


   
    private function toEntity(CourseModel $model): Course
    {
        return new Course(
            id: $model->id,
            instructorId: $model->instructor_id,
            title: $model->title,
            description: $model->description,
            slug: $model->slug,
            level: $model->level instanceof CourseLevel
                ? $model->level
                : CourseLevel::from($model->level),

            duration: $model->duration,
            price: $model->price,

            status: $model->status instanceof CourseStatus
                ? $model->status
                : CourseStatus::from($model->status),
        );
    }

}
