<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Repositories\ActivityRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class ActivityController extends Controller
{

    protected $repository;
    use ApiResponse;


    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        $data['rows'] = ActivityResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Activities loaded'));

    }


    public function store(ActivityRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if($request->flag){
              $item->flag =  $this->saveImage($request->flag,'Activities');
                $item->save();
            }
            return $this->createdApiResponse(new ActivityResource($item),__('Activities loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }

    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateActivityRequest
     * @return json response
     */
    public function update($id, ActivityRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->okApiResponse(new ActivityResource($item),__('Activities loaded'));
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
            return $this->okApiResponse(new ActivityResource($item),__('Activities loaded'));
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
            return $this->okApiResponse('',__('country deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
}
