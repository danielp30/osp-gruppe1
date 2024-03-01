<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informationsstand extends Model
{
    use HasFactory;

    protected $table = 'informationsstand'; // Specify the table name if it differs from the model name convention

    protected $fillable = [
        'user_id',
        'date',
        'status',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}