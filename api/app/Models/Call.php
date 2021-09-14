<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'technician_id',
        'action_id',
        'title',
        'description',
        'filepath',
        'status',
        'severity',
        'urgency',
        'trend',
        'gut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
