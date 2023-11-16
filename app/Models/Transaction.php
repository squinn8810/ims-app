<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('F d, Y');
    }
    
    public function getItem() {
        $itemLoc = ItemLocation::find($this->itemLocID);
        $item = Item::find($itemLoc->itemNum);
        return $item->itemName;
    }

    public function getLocation(){
        $itemLoc = ItemLocation::find($this->itemLocID);
        $location = Location::find($itemLoc->locID);
        return $location->locName;
    }

    public function getReorderQty(){
        $itemLoc = ItemLocation::find($this->itemLocID);
        return $itemLoc->itemReorderQty;
    }

    public function getUser() {
        $user = User::find($this->employeeID);
        return "$user->firstName $user->lastName";
    }


    /**
     * Get a custom message for the transaction.
     *
     * @return string
     */
    public function getMessage()
    {
        $reorderQty = $this->getReorderQty();
        $locName = $this->getLocation();
        $itemName = $this->getItem();
        $user = $this->getUser();

        $message = "$itemName from $locName by $user. Suggested reorder quantity: $reorderQty";

        return $message;
    }


    public function getDataAsJson()
    {
        return [
            'Date' => $this->getDateAttribute($this->transDate),
            'Item' => $this->getItem(),
            'Reorder Qty' => $this->getReorderQty(),
            'Location' => $this->getLocation(),
            'Status' => $this->status,
            'Employee' => $this->getUser(),
        ];
    }
}
