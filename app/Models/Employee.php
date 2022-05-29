<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model {

    use HasFactory,
        SoftDeletes;

    protected $table = "employees";
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status'
    ];
    protected $appends = [
        'full_name'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    // Accessor & Mutator for Full Name
    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

}
