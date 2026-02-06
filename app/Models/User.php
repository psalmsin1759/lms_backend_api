<?php

namespace App\Models;

use App\Enums\Status;
use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Permission as PermissionEnum;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
        'avatar',
        'phone',
        'timezone',
        'locale',
        'two_factor_enabled',
        'two_factor_secret',
        'last_login_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'role' => UserRole::class,
        'status' => Status::class,
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    
    /* // Courses taught (Instructor)
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    // Course enrollments (Learner)
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Quiz attempts
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Assignment submissions
    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // Certificates earned
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    // Notifications (optional if not using Laravel notifications table)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
 */
   

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

   

    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SUPER_ADMIN;
    }

    public function isOrgAdmin(): bool
    {
        return $this->role === UserRole::ORG_ADMIN;
    }

    public function isInstructor(): bool
    {
        return $this->role === UserRole::INSTRUCTOR;
    }

    public function isStudent(): bool
    {
        return $this->role === UserRole::STUDENT;
    }

    public function isGuest(): bool
    {
        return $this->role === UserRole::GUEST;
    }


    public function isActive(): bool
    {
        return $this->status === Status::ACTIVE;
    }

    public function isSuspended(): bool
    {
        return $this->status === Status::SUSPENDED;
    }

    public function isPending(): bool
    {
        return $this->status === Status::PENDING;
    }

    public function isCancelled(): bool
    {
        return $this->status === Status::CANCELLED;
    }

   

    /**
     * Super admins bypass tenant restrictions
     */
    public function isTenantScoped(): bool
    {
        return ! $this->isSuperAdmin();
    }

    public function hasPermission(PermissionEnum $permission): bool
    {
        // Super admin bypass
        if ($this->role === UserRole::SUPER_ADMIN) {
            return true;
        }

        return DB::table('role_permissions')
            ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('role_permissions.role', $this->role->value)
            ->where('permissions.name', $permission->value)
            ->exists();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
