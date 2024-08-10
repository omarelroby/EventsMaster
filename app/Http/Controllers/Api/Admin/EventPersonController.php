<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventPersonRequest;
use App\Http\Resources\EventPersonResource;
use App\Repositories\EventPersonRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventPersonController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventPersonRepository $repository)
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
        $Persons = $this->repository->paginate($request);
        $data['rows'] = EventPersonResource::collection($Persons);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Event Person loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\EventPersonRequest
     * @return json response
     */
    public function store(EventPersonRequest $request)
    {
        try {
            $Person = $this->repository->store($request);
            if($request->flag){
              $Person->flag =  $this->saveImage($request->flag,'Event Person');
                $Person->save();
            }
            return $this->createdApiResponse(new EventPersonResource($Person),__('Event Person loaded'));
        } catch (QueryException  $e) {
 return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateEventPersonRequest
     * @return json response
     */
    public function update($id, EventPersonRequest $request)
    {
        try {
            $Person = $this->repository->update($id, $request);
            return response()->json(['Person' => $Person]);
        } catch (QueryException $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * get single Person by id.
     * 
     * @param integer $id: integer post id.
     * @return json response.
     */
 
     public function show($id)
     {
         try {
            $Person= $this->repository->show($id);
            return $this->okApiResponse(new EventPersonResource($Person),__('Event Person loaded'));
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
            return $this->okApiResponse('',__('EventPerson deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}