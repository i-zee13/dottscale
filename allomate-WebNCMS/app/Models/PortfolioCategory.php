<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;   protected $guarded  =   [];
    protected $table    =   'portfolio_categories';
}
