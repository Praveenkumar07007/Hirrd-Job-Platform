<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'salary_range',
        'type',
        'status',
        'company_profile_id',
        'category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the company profile that owns the job.
     */
    public function companyProfile()
    {
        // Specify the correct foreign key name
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }

    /**
     * Get the category for this job.
     */
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    /**
     * Get the applications for this job.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
