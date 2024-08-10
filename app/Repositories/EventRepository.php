<?php
namespace App\Repositories;

use App\Models\Event;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Event $model)
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
            'email' => $request->input('email'),
            'abbreviation' => $request->input('abbreviation'),
            'name_tag' => $request->input('name_tag'),
            'zip' => $request->input('zip'),
            'phone1' => $request->input('phone1'),
            'phone2' => $request->input('phone2'),
            'whatsapp' => $request->input('whatsapp'),
            'website' => $request->input('website'),
            'city_id' => $request->input('city_id'),
            'president' => $request->input('president'),
            'start_date' => $request->input('start_date'),
            'registration_start_date' => $request->input('registration_start_date'),
             'registration_end_date' => $request->input('registration_end_date'),
             'event_end_date' => $request->input('event_end_date'),
             'public_event_start_date' => $request->input('public_event_start_date'),
             'shipping_start_date' => $request->input('shipping_start_date'),
             'street_adress' => $request->input('street_adress'),
             'map_location' => $request->input('map_location'),
             'event_specialty_id' => $request->input('event_specialty_id'),
             'event_series_id' => $request->input('event_series_id'),
             'discount' => $request->input('discount'),
             'map_lat' => $request->input('map_lat'),
             'map_lng' => $request->input('map_lng'),

             

        ];
    }
}