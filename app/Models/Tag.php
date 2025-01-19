<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes, HasFactory;

    const string COLUMN_ID = 'id';
    const string COLUMN_NAME = 'name';
    const string COLUMN_CODE = 'code';

    protected $fillable = [
        'code',
        'name',
    ];
}
