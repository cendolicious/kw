<?php
namespace App\Http\Controllers;
use App\Models\Checklist;
use App\Transformers\ChecklistCreateTransformer;
use App\Transformers\ChecklistTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ChecklistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fractal;
    public function __construct()
    {
        $this->fractal = new Manager();
    }
    /**
     * GET /checklists
     *
     * @return array
     */
    public function getList(){
        $paginator = Checklist::paginate();
        $checklist = $paginator->getCollection();
        $resource = new Collection($checklist, new ChecklistTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->fractal->createData($resource)->toArray();
    }

    public function getOne($id){
        $checklist = Checklist::find($id);
        $resource = new Item($checklist, new ChecklistTransformer());
        return $this->fractal->createData($resource)->toArray();
    }

    public function create(Request $request){
        //validate request parameters
        $this->validate($request, [
            'data.attributes.object_domain' => 'bail|required|max:255',
            'data.attributes.object_id' => 'bail|required',
        ]);
        $checklist = Checklist::create($request->all()['data']['attributes']);
        $resource = new Item($checklist, (new ChecklistCreateTransformer()));
        return $this->fractal->createData($resource)->toArray();
    }

    public function update($id, Request $request){
        //validate request parameters
        $this->validate($request, [
            'object_domain' => 'max:255',
        ]);
        //Return error 404 response if product was not found
        if(!Checklist::find($id)) return $this->errorResponse('Checklist not found!', 404);
        $checklist = Checklist::find($id)->update($request->all()['data']['attributes']);
        if($checklist){
            //return updated data
            $resource = new Item(Checklist::find($id), new ChecklistTransformer());
            return $this->fractal->createData($resource)->toArray();
        }
        //Return error 400 response if updated was not successful
        return $this->errorResponse('Failed to update checklist!', 400);
    }

    public function delete($id){

        //Return error 404 response if product was not found
        if(!Checklist::find($id)) return $this->errorResponse('Checklist not found!', 404);
        //Return 410(done) success response if delete was successful
        if(Checklist::find($id)->delete()){
            return $this->customResponse('Checklist deleted successfully!', 204);
        }
        //Return error 400 response if delete was not successful
        return $this->errorResponse('Failed to delete checklist!', 400);
    }

    public function customResponse($message = 'success', $status = 200)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }
}