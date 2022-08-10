<?php


namespace Marvel\Enums;

use BenSampo\Enum\Enum;

/**
 * Class RoleType
 * @package App\Enums
 */
final class WithdrawStatus extends Enum
{
    public const APPROVED = 'approved';
    public const PENDING = 'pending';
    public const ON_HOLD = 'on_hold';
    public const REJECTED = 'rejected';
    public const PROCESSING = 'processing';
}
