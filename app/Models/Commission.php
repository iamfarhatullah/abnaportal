<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'portal_id',
        'commission_percentage',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
}
