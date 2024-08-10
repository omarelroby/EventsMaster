<?php
namespace App\Repositories;
use App\Models\EventType;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventTypeRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventType $model)
    {
        $this->model = $model;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [specification]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'serial_number' => $request->input('serial_number'),
            'specification' => $request->input('specification')


        ];
    }
}