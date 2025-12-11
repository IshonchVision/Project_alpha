<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_student';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'student_id',
        'enrolled_at',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enrolled_at' => 'date',
    ];

    /**
     * Get the group that owns the enrollment.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the student that owns the enrollment.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Scope for active enrollments
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive enrollments
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope for completed enrollments
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for dropped enrollments
     */
    public function scopeDropped($query)
    {
        return $query->where('status', 'dropped');
    }

    /**
     * Check if enrollment is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if enrollment is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Mark enrollment as completed
     */
    public function markAsCompleted(): bool
    {
        return $this->update(['status' => 'completed']);
    }

    /**
     * Mark enrollment as dropped
     */
    public function markAsDropped(): bool
    {
        return $this->update(['status' => 'dropped']);
    }

    /**
     * Get enrollment duration in days
     */
    public function getDurationInDays(): int
    {
        return $this->enrolled_at->diffInDays(now());
    }

    /**
     * Get formatted enrollment date
     */
    public function getFormattedEnrolledDate(): string
    {
        return $this->enrolled_at->format('d.m.Y');
    }
}