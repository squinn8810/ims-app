<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLocation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'item_location';

    protected $primaryKey = 'itemLocID';


    protected $fillable = [
        'itemNum', 'itemReorderQty', 'locID',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemNum');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'locID');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'itemLocID');
    }
}
