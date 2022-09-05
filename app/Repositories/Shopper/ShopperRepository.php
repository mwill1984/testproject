<?php

namespace App\Repositories\Shopper;

use App\Models\Shopper\Shopper;
use App\Models\Shopper\Status;
use App\Repositories\BaseRepository;

/**
 * Class ShopperRepository
 * @package App\Repositories\Shopper
 */
class ShopperRepository extends BaseRepository
{
    /**
     * @var Shopper
     */
    protected $shopper;

    /**
     * ShopperRepository constructor.
     * @param Shopper $shopper
     */
    public function __construct(Shopper $shopper)
    {
        $this->shopper = $shopper;
        parent::__construct($this->shopper);
    }
    
     /*
     * Retrieve this shopper's position in line
     * @return int 
     */
    public function getPositionInQueue($uuid) {
        
        $shopper = Shopper::where('uuid', $uuid)->first();
        
        $pendingStatusId = Status::getStatusIdFromStatusName('Pending');
        
        if($shopper->status_id != $pendingStatusId) {
            return 0;
        } else {
            return Shopper::where('location_id', $shopper->location_id)
                ->where('status_id', $pendingStatusId)
                ->whereTime('check_in', '<=', $shopper->check_in)
                ->count();
        }
    }
}
