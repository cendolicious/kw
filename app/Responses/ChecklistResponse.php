<?php
/**
 * Created by PhpStorm.
 * User: Sabriyan
 * Date: 11/23/2019
 * Time: 9:48 PM
 */

namespace App\Responses;

use App\Libraries\ChecklistLibrary;
use App\Transformers\ChecklistTransformer;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

class ChecklistResponse
{

    protected $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();
    }

    public function generateResponse($message, $data, $status = 200 ) {

        $content = ['message' => $message];

        if($data != null) {

            $resource = new Item($data, new ChecklistTransformer());
            $resource = $this->fractal->createData($resource)->toArray();

            $content = array_merge($content, $resource);

        }else {
            $content['message'] = ChecklistLibrary::NO_DATA_FOUND;
            $content = array_merge($content, ['data' => []]);

        }

        return (new Response($content, $status))
            ->header('Content-Type', 'application/json');
    }

    public function generateResponsePagination($message, $data ) {

        $checklist = $data->getCollection();
        $resource = new Collection($checklist, new ChecklistTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($data));
        return $this->fractal->createData($resource)->toArray();
    }

}