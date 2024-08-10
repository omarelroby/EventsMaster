<?php
namespace App\Repositories;

use App\Models\OrgLegalForm;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class OrganizationLegalFormRepository extends AppRepository
{
    protected $model;
    
    public function __construct(OrgLegalForm $model)
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
            'legal_form_sn' => $request->input('legal_form_sn'),
            'legal_form_spc' => $request->input('legal_form_spc'),
            'legal_form_abv' => $request->input('legal_form_abv'),
            'legal_form_code' => $request->input('legal_form_code')



        ];
    }
}