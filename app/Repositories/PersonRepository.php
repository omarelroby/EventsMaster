<?php
namespace App\Repositories;

use App\Models\Person;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class PersonRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Person $model)
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
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'surName' => $request->input('surName') , 
            'name_tag' => $request->input('name_tag'),
            'ID'  => $request->input('ID'),
            'id_type'=>  $request->input('id_type'),
            'id_expiration' => $request->input('id_expiration'),
            'Honor' => $request->input('Honor'),
            'email' => $request->input('email') , 
            'birthdate' => $request->input('birthdate'),
            'gender'  => $request->input('gender'),
            'zip'=>  $request->input('zip'),

            'Phone1' => $request->input('Phone1') , 
            'WhatsApp' => $request->input('WhatsApp'),
            'street_address'  => $request->input('street_address'),
            'linkedIn'=>  $request->input('linkedIn'),
            'Phone1' => $request->input('Job_title') , 
            'WhatsApp' => $request->input('city_id'),
            'street_address'  => $request->input('country_id'),
            'linkedIn'=>  $request->input('leader_Sn'),
            'account_number'=>  $request->input('account_number')
        ];
    }
}