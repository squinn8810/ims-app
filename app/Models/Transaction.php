<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'transaction';

    protected $primaryKey = 'transNum';

    /**
     * 
     */
    protected $fillable = [
        'transDate', 'itemLocID', 'employeeID', 'is_pending', 'is_acknowledged', 'is_ordered'
    ];

    /**
     * 
     */
    public function itemLocation()
    {
        return $this->belongsTo(ItemLocation::class, 'itemLocID');
    }

    /**
     * 
     */
    public function employee()
    {
        return $this->belongsTo(Account::class, 'employeeID');
    }

    /**
     * 
     */
    public function getMessage()
    {
            $itemLoc = ItemLocation::find($this->itemLocID);
            $locId = $itemLoc->locID;
            $reorderQty = $itemLoc->itemReorderQty;
            $location = Location::find($locId);
            $locName = $location->locName;
            $itemNum = $itemLoc->itemNum;
            $item = Item::find($itemNum);
            $itemName = $item->itemName;
            $name = auth()->user()->lastName;

            $message = "$itemName from $locName by $name. Suggested reorder quantity: $reorderQty";

            return $message;

    }

}
