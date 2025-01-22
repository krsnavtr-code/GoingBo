<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    static function myCoupons($type)
    {
        $user = session()->get('user')['userId'] ?? null;
        $coupons = [];

        $temps = Coupon
            // Valid Till Period
            ::where('valid_till', '>', now()->timestamp * 1000)
            // Lifetime Valid
            ->orWhere('valid_till', null)
            ->get()->toArray();

        foreach ($temps as $temp)
            if (
                // If applicable for all
                ($temp['applicable_for'][0] == '*' ||
                    (
                        // If applicable for user
                        in_array($user, $temp['applicable_for']) &&
                        // if not used by user
                        !in_array($user, $temp['used_by'] ?? [])
                    )) &&
                // Coupon is valif for service
                in_array($type, $temp['allowed_for'])
            ) $coupons[] = $temp;
        return $coupons;
    }
    static function getDiscount($coupon)
    {
        $coupon = Coupon
            ::Where('coupon_code', $coupon)->first()->toArray();
        return rand($coupon['coupon_min_discount'], $coupon['coupon_max_discount']);
    }
}
