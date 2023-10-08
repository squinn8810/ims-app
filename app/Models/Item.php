<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $primaryKey = 'itemNum';

    protected $fillable = [
        'itemNum', 'itemName', 'itemURL', 'vendorName', 'vendorID',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendorID');
    }

    public function locations()
    {
        return $this->hasMany(ItemLocation::class, 'itemLocID');
    }
}
