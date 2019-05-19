<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Resources\Review\ReviewResource;
use App\Http\Requests\ReviewRequest;

use Auth;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
//use Zend\Diactoros\Response;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ProductNotBelongToUserException;


class ReviewController extends Controller
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
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews) ;//Review::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request,Product $product)
    {
        $request["user_id"] = Auth::id();
       $review= new Review($request->all());
        $product->reviews()->save($review);
        return response([

           "data"=>new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */

    public function CheckReviewUser($review)
    {

        if ($review->user_id !== Auth::id())
            throw  new ProductNotBelongToUserException;

    }
    public function update(ReviewRequest $request,Product $product, Review $review)
    {

       
        $this->CheckReviewUser($review);


        $review->update($request->all());
        return response([

            "data" => new ReviewResource($review)
        ], Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Review $review)
    {
        $review->delete();
        return response("Deleted Sucsesfully",200);

    }
}
