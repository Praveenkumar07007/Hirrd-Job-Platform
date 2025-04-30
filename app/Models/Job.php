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
        'company_id',
        'category_id',
        'image',
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
     * Get the default job image URL.
     *
     * @return string
     */
    public function getJobImageUrlAttribute()
    {
        return $this->image ?? 'https://imgs.search.brave.com/FRAhWH5QAt0XCT-eUBtH4AEhB392p0-E2_JMt12CLVM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/cGl4YWJheS5jb20v/cGhvdG8vMjAxNy8x/MC8xNy8xMC8wNS9q/b2ItMjg2MDAzNV82/NDAuanBn';
    }

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
