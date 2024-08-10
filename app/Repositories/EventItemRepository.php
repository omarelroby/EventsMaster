<?php
namespace App\Repositories;

use App\Models\EventItem;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventItemRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventItem $model)
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
            'title' => $request->input('title'),
            'content_summary' => $request->input('content_summary'),
            'auther_id' => $request->input('auther_id'),
            'review' => $request->input('review'),
            'acceptability' => $request->input('acceptability'),
            'number_of_copies' => $request->input('number_of_copies'),
            'ISBN_number' => $request->input('ISBN_number'),
            'price' => $request->input('price'),
            'organization_discount' => $request->input('organization_discount'),
            'organization_id' => $request->input('organization_id'),
            'event_id' => $request->input('event_id')

           

        ];
    }
}