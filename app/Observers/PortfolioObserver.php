<?php

namespace App\Observers;

use App\Models\Portfolio\Portfolio;

class PortfolioObserver
{
    //
    public function deleting(Portfolio $portfolio)
    {
        $portfolio->attachment->each->delete();
    }
}
