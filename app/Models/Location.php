<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location';

    protected $primaryKey = 'locID';

    protected $fillable = [
        'locName', 'locAddress', 'locCity', 'locState', 'locZip',
    ];

    public function items()
    {
        return $this->hasMany(ItemLocation::class, 'locID');
    }

}
