<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'code', 'link','titles','clicks','user_id'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function ShortLink()
    {
        return $this->hasMany(ShortLink::class, 'code_id', 'id');
    }

}
