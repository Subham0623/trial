<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviews = Review::all();

        return view('admin.reviews.index', compact('reviews'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return back();

    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        Review::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function approve(Request $request, Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->status = 1;
        $review->save();
        return redirect()->back();
    }

    public function reject(Request $request, Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->status = -1;
        $review->save();
        return redirect()->back();
    }
}
