<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaBahaya extends Model
{
    use HasFactory;

    protected $table = 'tanda_bahaya';

    protected $fillable = [
        'model',
        'record_id',
        'danger_sign'
    ];
}
