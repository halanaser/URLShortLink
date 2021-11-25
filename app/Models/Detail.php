<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address', 'user_agent','code_id'
    ];

    public function ShortLink()
    {
        return $this->belongsTo(ShortLink::class, 'code_id', 'id');
    }
}
