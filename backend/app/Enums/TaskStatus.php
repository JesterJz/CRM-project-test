<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static open()
 * @method static static in_progress()
 * @method static static completed()
 * @method static static pending()
 */
final class TaskStatus extends Enum
{
    const Open = 'open';
    const InProgress = 'in_progress';
    const Completed = 'completed';
    const Pending = 'pending';
}
