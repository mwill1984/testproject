<?php

namespace App\Models\Shopper;

use App\Models\Store\Location\Location;
use App\Models\Shopper\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Shopper
 * @package App\Models\Shopper
 */
class Shopper extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['first_name', 'last_name', 'email', 'status_id', 'location_id', 'check_in'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    
    /**
     * 
     * Get the number of active shoppers in a location.
     * @param type $location_id
     * @return int
     */
    public static function countActiveShoppers($location_id) : int {
        return Shopper::where('location_id', $location_id)
                ->where('status_id', Status::getStatusIdFromStatusName('Active'))
                ->count();
    }
    
    /**
     * 
     * Get the number of queued shoppers in a location.
     * @param type $location_id
     * @return int
     */
    public static function countQueuedShoppers($location_id) : int {
        return Shopper::where('location_id', $location_id)
                ->where('status_id', Status::getStatusIdFromStatusName('Pending'))
                ->count();
    }
    
    /**
     * 
     * Activate the next shopper at the location given.
     * @param type $location_id
     * 
     */
    public static function activateNextShopper($location_id) {
        Shopper::where('location_id', $location_id)
                ->where('status_id', Status::getStatusIdFromStatusName('Pending'))
                ->orderBy('check_in', 'DESC')
                ->take(1)
                ->update([
                    'status_id' => Status::getStatusIdFromStatusName('Active'),
                    'activated' => now()
                ]);
    }
    
    /**
     * 
     * Checkout a single shopper.
     * @param type $shopper_id
     * 
     */
    public static function checkoutShopper($shopper_id) {
        Shopper::where('id', $shopper_id)
                ->update([
                   'check_out' => now(),
                   'status_id' => Status::getStatusIdFromStatusName('Completed')
                ]);
    }
    
    /**
     * Checkout shoppers that have been active for longer than two hours.
     */
    public static function checkoutExpiredShoppers() {
        
        $expiredShoppers = Shopper::where('status_id', Status::getStatusIdFromStatusName('Active'))
                ->whereTime('activated', '<', date('Y-m-d H:i:s', strtotime("-2 hour")))
                ->get();
        
        foreach($expiredShoppers as $expiredShopper) {
            Shopper::checkoutShopper($expiredShopper->id);
        }
    }
    
    /*
     * Process the queue.
     */
    public static function processQueue() {
        
        Shopper::checkoutExpiredShoppers();
        
        foreach(Location::all() as $location) {  
            
            //If the location has fewer active shoppers than the limit, let in as many shoppers as we can.
            $activeCount =  Shopper::countActiveShoppers($location->id);
            
            echo $location->id . " Active: " . $activeCount . " Limit: " . $location->shopper_limit . " Queued: " . Shopper::countQueuedShoppers($location->id) . "\n";
            
            if ($activeCount < $location->shopper_limit) {
                
                $numberInQueue = Shopper::countQueuedShoppers($location->id);
                $excessCapacity = $location->shopper_limit - $activeCount;
                $numberToActivate = min($numberInQueue, $excessCapacity);
                
                for ($i = 0; $i < $numberToActivate; $i++) {
                    Shopper::activateNextShopper($location->id);
                }
            }
        }
    }
}
