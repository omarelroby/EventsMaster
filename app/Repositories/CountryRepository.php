<?php
namespace App\Repositories;

use App\Models\Country;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class CountryRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Country $model)
    {
        $this->model = $model;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'initials' => $request->input('initials'),
            'nationality' => $request->input('nationality')

        ];
    }
}