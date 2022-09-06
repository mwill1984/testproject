<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Shopper\Shopper;
use App\Services\Shopper\ShopperService;

/**
 * 
 * Class EmployeeShopperController
 * @package App\Http\Controllers\Store
 */
class EmployeeShopperController extends Controller {
    
    /*
     * @var ShopperService
     */
    protected $shopper;
    
    public function __construct(ShopperService $shopper) {
        $this->shopper = $shopper;
    }
    
    /*
     * Checkout the shopper identified by id
     * @var shopperid
     * 
     */
    public function checkout($storeUuid, $shopperUuid) {

        $shopper = Shopper::where('uuid', $shopperUuid)->first();
        
        Shopper::checkoutShopper($shopper->id);
        
        return redirect()->back();
    }
    
}