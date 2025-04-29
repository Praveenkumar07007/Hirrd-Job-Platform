<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'description',
        'website',
        'industry',
        'address',
        'user_id',
        'logo',
    ];

    /**
     * Get the user that owns the company profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs for the company.
     */
    public function jobs()
    {
        // Specify the correct foreign key name
        return $this->hasMany(Job::class, 'company_id');
    }

    /**
     * Get active jobs for the company.
     */
    public function activeJobs()
    {
        // Specify the correct foreign key name and use the correct status column
        return $this->hasMany(Job::class, 'company_id')->where('is_active', true);
    }
}
