<?php


namespace Marvel\Enums;

use BenSampo\Enum\Enum;

/**
 * Class RoleType
 * @package App\Enums
 */
final class ShippingType extends Enum
{
    public const FIXED = 'fixed';
    public const PERCENTAGE = 'percentage';
    public const FREE = 'free_shipping';
    public const
        DEFAULT = 'fixed';
}
