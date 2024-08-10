<?php
namespace App\Repositories;

use App\Models\EventSeries;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventSeriesRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventSeries $model)
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
            'name' => $request->input('name')

        ];
    }
}