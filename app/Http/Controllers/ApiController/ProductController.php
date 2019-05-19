<?php

namespace App\Http\Controllers\ApiController;

use App\Product;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
//use Zend\Diactoros\Response;
use function PHPSTORM_META\type;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ProductNotBelongToUserException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
         $userId = $request->user()->id;
        //return $request->user();
        //
         $product = new Product;

        $product->name = $request->name;
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->image = $request->image;
        $product->seller_id = $userId;


        $product->save();

        return response([

            "data" => new ProductResource($product)
        ], Response::HTTP_CREATED);
        // return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */


    public function CheckProductUser($product)
    {
        if ($product->seller_id !== Auth::id())
            throw  new ProductNotBelongToUserException;

    }

    public function update(ProductRequest $request, Product $product)
    {
      //  return Auth::id();

         $this->CheckProductUser($product);

        $request["detail"] = $request->description;
        unset($request->description);

        $product->update($request->all());
        return response([

            "data" => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->CheckProductUser($product);

        $product->delete();

        return response("Deleted Sucsesfully", "200");
    }


}
