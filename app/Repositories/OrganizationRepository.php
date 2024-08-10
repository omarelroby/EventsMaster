<?php
namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class OrganizationRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Organization $model)
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
            'organization_Sn' => $request->input('organization_Sn'),
            'commercial_Name' => $request->input('commercial_Name') , 
            'name_tag' => $request->input('name_tag'),
            'commercial_rgistryID '  => $request->input('commercial_rgistryID'),
            'commercial_registry_expiration'=>  $request->input('commercial_registry_expiration'),
            'commercial_registry_file' => $request->input('commercial_registry_file'),
            'tax_registryID' => $request->input('tax_registryID'),
            'tax_registry_expiration' => $request->input('tax_registry_expiration') , 
            'email' => $request->input('email'),
            'establish_date'  => $request->input('establish_date'),
            'zip'=>  $request->input('zip'),

            'Phone1' => $request->input('Phone1') , 
            'Phone2' => $request->input('Phone2') , 
            'WhatsApp' => $request->input('WhatsApp'),
            'head_office_address'  => $request->input('head_office_address'),
            'website'=>  $request->input('website'),
            'city_id' => $request->input('city_id') , 
            'nationality_country_Id' => $request->input('nationality_country_Id'),
            'org_classification_id'  => $request->input('org_classification_id'),
            'legal_form_id'=>  $request->input('legal_form_id'),
            'organization_parent_Sn'=>  $request->input('organization_parent_Sn'),
            'manager_id' => $request->input('manager_id'),
            'iban'  => $request->input('iban'),
            'swift_code'=>  $request->input('swift_code'),
            'bank' => $request->input('bank') , 
            'account_number' => $request->input('account_number')
        ];
    }
}