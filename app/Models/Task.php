<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    
    protected $fillable=[
        'name',
        'description',
        'priority',
        'completed',
        'user_id'
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etiqueta()
    {
        return $this->belongsToMany(Etiqueta::class,'task_etiqueta');
    }
}
