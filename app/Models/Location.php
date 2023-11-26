<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'location';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'locID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locName', 'locAddress', 'locCity', 'locState', 'locZip', 'organization_id'
    ];

    /**
     * Get the items associated with the location.
     */
    public function items()
    {
        return $this->hasMany(ItemLocation::class, 'locID');
    }

      /**
     * Get the employee associated with the transaction.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

}
