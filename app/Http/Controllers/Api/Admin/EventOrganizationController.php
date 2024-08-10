<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventOrganizationRequest;
use App\Http\Resources\EventOrganizationResource;
use App\Repositories\EventOrganizationRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventOrganizationController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventOrganizationRepository $repository)
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
        $data['rows'] = EventOrganizationResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Event Organizations loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\EventOrganizationRequest
     * @return json response
     */
    public function store(EventOrganizationRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if($request->flag){
              $item->flag =  $this->saveImage($request->flag,'Event Organizations');
                $item->save();
            }
            return $this->createdApiResponse(new EventOrganizationResource($item),__('Event Organizations loaded'));
        } catch (QueryException  $e) {
 return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateEventOrganizationRequest
     * @return json response
     */
    public function update($id, EventOrganizationRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return response()->json(['item' => $item]);
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
            return $this->okApiResponse(new EventOrganizationResource($item),__('Event Organizations loaded'));
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
            return $this->okApiResponse('',__('EventOrganization deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}