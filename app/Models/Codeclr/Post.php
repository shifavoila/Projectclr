<?php

namespace App\Models\Codeclr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
