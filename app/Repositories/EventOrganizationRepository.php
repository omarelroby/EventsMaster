<?php
namespace App\Repositories;

use App\Models\EventOrganization;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventOrganizationRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventOrganization $model)
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
            'egent_id' => $request->input('egent_id'),
            'end_date' => $request->input('end_date'),
            'start_date' => $request->input('start_date'),
            'number_of_shipping' => $request->input('number_of_shipping'),
            'issues_quantity' => $request->input('issues_quantity'),
            'issues_quantity' => $request->input('issues_quantity'),
            'publishing_license' => $request->input('publishing_license'),
            'local_publishers_membership' => $request->input('local_publishers_membership'),
            'raranking' => $request->input('raranking'),
            'account_number' => $request->input('account_number'),
            'list_type_id' => $request->input('list_type_id'),
            'organization_id' => $request->input('organization_id'),
            'event_id' => $request->input('event_id')

           

        ];
    }
}