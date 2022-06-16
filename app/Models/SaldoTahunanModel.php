<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoTahunanModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 't_saldo_tahunan';

}
