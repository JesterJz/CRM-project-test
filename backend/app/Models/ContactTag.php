<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContactTag extends Pivot
{
    protected $table = 'opportunity_tag';
}
