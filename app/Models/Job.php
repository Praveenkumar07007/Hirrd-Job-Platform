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
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'company_id',
        'category_id',
        'location',
        'type',
        'salary',
        'deadline',
        'is_active',
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
     * Get the company that owns the job.
     */
    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }

    /**
     * Get the category for the job.
     */
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
