<?php
namespace App\Repositories;

use App\Models\AccompanyingEvent;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class AccompanyingEventRepository extends AppRepository
{
    protected $model;
    
    public function __construct(AccompanyingEvent $model)
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
            'country_id' => $request->input('country_id'),
            'initials' => $request->input('initials')

        ];
    }
}