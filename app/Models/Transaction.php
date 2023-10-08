<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $primaryKey = 'transNum';


    protected $fillable = [
        'transDate', 'itemLocID', 'employeeID',
    ];

    public function itemLocation()
    {
        return $this->belongsTo(ItemLocation::class, 'itemLocID');
    }

    public function employee()
    {
        return $this->belongsTo(Account::class, 'employeeID');
    }

}
