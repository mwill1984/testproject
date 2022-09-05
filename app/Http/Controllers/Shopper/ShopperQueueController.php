<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Shopper\ShopperService;
use App\Http\Requests\Shopper\ShopperCreateRequest;
use App\Models\Shopper\Status;
use App\Models\Shopper\Shopper;
use App\Models\Store\Location\Location;
use App\Services\Store\Location\LocationService;

class ShopperQueueController extends Controller
{
    /*
     * @var ShopperService
     */
    protected $shopper;
    
    public function __construct(ShopperService $shopper) {
        $this->shopper = $shopper;
    }
    
    //
    public function checkin(ShopperCreateRequest $request) : \Illuminate\Http\RedirectResponse {
        
        $shopperArray = $this->shopper->create([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'email' => $request->email, 
            'location_id' => $request->location_id, 
            'status_id' => Status::getStatusIdFromStatusName('Pending'),             
            'check_in' => now()
        ])->toArray();
        
        return redirect()->route('public.queuewaiting', $shopperArray['uuid']);
    }
    
    
    /*
     * View for waiting in the queue.
     */
    public function queuewaiting($uuid) {
        
        $shopper = Shopper::where('uuid', $uuid)->first();
        $location = Location::where('id', $shopper->location_id)->first();
        $position = $this->shopper->getPositionInQueue($uuid);
        
        return view('stores.location.queuewaiting')
            ->with('position', $position)
            ->with('shopper', $shopper)
            ->with('location', $location);
    }
}
