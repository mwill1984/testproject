<?php

namespace App\Models\Shopper;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Status
 * @package App\Models\Shopper
 */
class Status extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shopper::class);
    }
    
    /*
     * Retrieve the id value for the given status
     * @param name string
     * @return int
     */
    public static function getStatusIdFromStatusName($name) : int {
        
        $status = Status::where('name', $name)->get();
        return $status[0]->id;
        
    }
    
}
