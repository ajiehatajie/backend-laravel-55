<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
class BLogController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search) {
          $data = Post::Published()->where('title','like','%'.$search.'%')
                  ->orWhere('excerpt','like','%'.$search.'%')
                  ->orWhere('body','like','%'.$search.'%')->with('authorId')->with('category')->jsonPaginate();
        } else {
          $data = Post::Published()->orderBy('id','desc')->with('authorId')->with('category')->jsonPaginate();
        }
        return $this->listResponse($data);
    }

    public function show(Request $request,$slug)
    {
        $data = Post::Published()->where('slug',$slug)->with('authorId')->with('category')->firstOrFail();
        return $this->listResponse($data);
    }

    protected function showResponse($data)
    {
        $response = [
        'code' => 200,
        'status' => 'succcess',
        'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
    protected function listResponse($data)
    {
        $response = [
        'code' => 200,
        'status' => 'succcess',
        'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
    protected function notFoundResponse()
    {
        $response = [
        'code' => 404,
        'status' => 'error',
        'data' => 'Resource Not Found',
        'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }

    protected function clientErrorResponse($data)
    {
        $response = [
        'code' => 422,
        'status' => 'error',
        'data' => $data,
        'message' => 'Unprocessable entity'
        ];
        return response()->json($response, $response['code']);
    }
}
