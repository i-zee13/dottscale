<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
class SubscribersList extends Model {
    protected $guarded = [];
    use HasFactory;
    protected $table = "subscribers_list";
}
