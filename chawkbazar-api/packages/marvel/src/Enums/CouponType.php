<?php


namespace Marvel\Enums;

use BenSampo\Enum\Enum;

/**
 * Class RoleType
 * @package App\Enums
 */
final class CouponType extends Enum
{
    public const FIXED_COUPON = 'fixed';
    public const PERCENTAGE_COUPON = 'percentage';
    public const FREE_SHIPPING_COUPON = 'free_shipping';
    public const DEFAULT_COUPON = 'fixed';
}
