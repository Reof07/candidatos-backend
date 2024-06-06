<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function getAll()
    {
        return Lead::all();

        // return Cache::remember('candidates', 60, function () {
        //     return Candidate::all();
        // });
    }

    public function findOne($id){
        return Lead::find($id);
    }
}
