<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InterestRequest;
use App\Http\Resources\InterestResource;
use App\Repositories\InterestRepository;
use Illuminate\Database\QueryException;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class InterestController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(InterestRepository $repository)
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
        $data['rows'] = InterestResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        
        return $this->okApiResponse($data,__('interests loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\InterestRepository
     * @return json response
     */
    public function store(InterestRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return $this->createdApiResponse(new InterestResource($item),__('interests loaded'));
        } catch (QueryException  $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatus());

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\InterestRepository
     * @return json response
     */
    public function update($id, InterestRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->createdApiResponse(new InterestResource($item),__('interests loaded'));
        } catch (QueryException $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatus());
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
            return $this->okApiResponse(new InterestResource($item),__('interests loaded'));
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
            return $this->okApiResponse('',__('Interset deleted'));
        } catch (QueryException $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatus());
        }
    }
}