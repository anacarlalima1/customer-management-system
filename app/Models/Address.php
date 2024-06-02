<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use SoftDeletes;
    protected $table = 'addresses';
    protected $fillable = ['type', 'cep', 'street', 'number', 'complement', 'district', 'state', 'city', 'client_id'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
