<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public static $hours = ['08-09','09-10','10-11','11-12','15-16','16-17','17-18','18-19','19-20','20-21'];

    protected $fillable = [
        'user_id',
        'machine_id',
        'date',
        'hour',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
