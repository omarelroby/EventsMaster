<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventTypeRequest;
use App\Http\Resources\EventTypeResource;
use App\Repositories\EventTypeRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventTypeController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventTypeRepository $repository)
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
        $data['rows'] = EventTypeResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Event Types loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\EventTypeRequest
     * @return json response
     */
    public function store(EventTypeRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if($request->flag){
              $item->flag =  $this->saveImage($request->flag,'Event Types');
                $item->save();
            }
            return $this->createdApiResponse(new EventTypeResource($item),__('Event Types loaded'));
        } catch (QueryException  $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatus());

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateEventTypeRequest
     * @return json response
     */
    public function update($id, EventTypeRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return response()->json(['item' => $item]);
        } catch (QueryException $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
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
            return $this->okApiResponse(new EventTypeResource($item),__('Event Types loaded'));
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
            return $this->okApiResponse('',__('EventType deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}