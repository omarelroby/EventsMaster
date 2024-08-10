<?php
namespace App\Repositories;

use App\Models\OrgClasification;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class OrganizationClassificationRepository extends AppRepository
{
    protected $model;
    
    public function __construct(OrgClasification $model)
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
            'classification_sn' => $request->input('classification_sn'),
            'classification_spc' => $request->input('classification_spc'),
            'classification_code' => $request->input('classification_code')



        ];
    }
}