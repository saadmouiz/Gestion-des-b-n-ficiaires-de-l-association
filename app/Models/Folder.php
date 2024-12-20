<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_path'];


    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
