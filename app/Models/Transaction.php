<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model for the "transaction" table.
 */
class Transaction extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transNum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transDate', 'itemLocID', 'employeeID', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $enumCasts = [
        'status' => 'array'
    ];

    /**
     * Get the item location associated with the transaction.
     */
    public function itemLocation()
    {
        return $this->belongsTo(ItemLocation::class, 'itemLocID');
    }

    /**
     * Get the employee associated with the transaction.
     */
    public function employee()
    {
        return $this->belongsTo(Account::class, 'employeeID');
    }

    /**
     * Get a custom message for the transaction.
     *
     * @return string
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
