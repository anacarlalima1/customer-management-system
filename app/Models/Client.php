<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';
    protected $fillable = ['name', 'social_name', 'cpf', 'father_name', 'mother_name', 'phone', 'email'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
