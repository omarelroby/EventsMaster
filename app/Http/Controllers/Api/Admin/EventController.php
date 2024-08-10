<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
     * get list of all the posts.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        $data['rows'] = EventResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Event loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\EventRequest
     * @return json response
     */
    public function store(EventRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if($request->logo){
              $item->logo =  $this->saveImage($request->logo,'Events');
                $item->save();
            }
            return $this->createdApiResponse(new EventResource($item),__('Events loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateEventRequest
     * @return json response
     */
    public function update($id, EventRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->createdApiResponse(new EventResource($item),__('Events loaded'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
  
    /**
     * get single item by id.
     * 
     * @param integer $id: integer post id.
     * @return json response.
     */
 
     public function show($id)
     {
         try {
            $item= $this->repository->show($id);
            return $this->okApiResponse(new EventResource($item),__('Events loaded'));
        } catch (QueryException $e) {
                return $this->notFoundApiResponse('',$e->getMessage());
         }
     }
    /**
     * delete post by id.
     * 
     * @param integer $id: integer post id.
     * @return json response.
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->okApiResponse('',__('Event deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
}