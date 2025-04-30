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
     * Get the company logo URL.
     *
     * @return string
     */
    public function getCompanyLogoUrlAttribute()
    {
        // First try the uploaded logo
        if ($this->logo && file_exists(public_path('storage/' . $this->logo))) {
            return asset('storage/' . $this->logo);
        }

        // Then try the specific image in public storage
        if (file_exists(public_path('storage/company_logos/image.png'))) {
            return url('/storage/company_logos/image.png');
        }

        // Return a data URI for an SVG as fallback
        return $this->generateLogoSvg();
    }

    /**
     * Generate an SVG logo for the company based on its name.
     *
     * @return string
     */
    public function generateLogoSvg()
    {
        // Get company initials (up to 2 characters)
        $name = $this->company_name ?? 'Company';
        $initials = strtoupper(substr($name, 0, 1));
        if (str_contains($name, ' ')) {
            $parts = explode(' ', $name);
            $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
        }

        // Generate a consistent color based on company name
        $hash = md5($name);
        $hue = hexdec(substr($hash, 0, 2)) % 360; // 0-359 degrees
        $saturation = 65; // 65%
        $lightness = 50; // 50%

        // Create the SVG
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
  <rect width="100" height="100" fill="hsl({$hue}, {$saturation}%, {$lightness}%)" />
  <text x="50" y="50" font-family="Arial, sans-serif" font-size="40" font-weight="bold"
    fill="white" text-anchor="middle" dominant-baseline="central">{$initials}</text>
</svg>
SVG;

        // Return as a data URI
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

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
