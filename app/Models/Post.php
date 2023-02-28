<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'author_name',
        'publication_date',
        'p_image',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}