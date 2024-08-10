<?php
namespace App\Repositories;

use App\Models\EventPerson;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventPersonRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventPerson $model)
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
            'id' => $request->input('id'),
            'acceptability' => $request->input('acceptability'),
            'revision' => $request->input('revision'),
            'end_date' => $request->input('end_date'),
            'start_date' => $request->input('start_date'),
            'vip' => $request->input('vip'),
            'role' => $request->input('role'),
            'account_number' => $request->input('account_number'),
            'list_type_id' => $request->input('list_type_id'),
            'person_id' => $request->input('person_id'),
            'event_id' => $request->input('event_id')


        ];
    }
}