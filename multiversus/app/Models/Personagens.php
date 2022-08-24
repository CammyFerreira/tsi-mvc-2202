<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personagens extends Model
{
    use HasFactory;

    protected $fillable = [ 'id',
                            'nome',
                            'classe',
                            'franquia',
                            'roupa'];

    protected $table = 'personagens';

}

