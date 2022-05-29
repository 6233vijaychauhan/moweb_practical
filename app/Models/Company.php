<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Company extends Model {

    use HasFactory,
        SoftDeletes;

    protected $table = "companies";
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'status'
    ];
    protected $appends = [
        'logo_full_path'
    ];

    public function getEmployeeDetails() {
        return $this->hasOne(Employee::class);
    }

    public function getLogoFullPathAttribute() {
        $exists = Storage::disk('local')->exists('public/company/' . $this->logo);
        if ($exists && !empty($this->logo)) {
            return config("app.image_url") . "storage/company/$this->logo";
        }
        return config('constants.defaultImage.default');
    }

}
