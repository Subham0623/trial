<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupportRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use Gate;
use App\Support;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;


class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('support_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supports = Support::all();

        return view('admin.supports.index', compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       abort_if(Gate::denies('support_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $products = Product::all();

        return view('admin.supports.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportRequest $request)
    {
        $support = Support::create($request->all());
        
        return redirect()->route('admin.supports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        abort_if(Gate::denies('support_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supports.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        abort_if(Gate::denies('support_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all();

        return view('admin.supports.edit',compact('support','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportRequest $request, Support $support)
    {
        $support->update($request->all());
        
        return redirect()->route('admin.supports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        abort_if(Gate::denies('support_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $support->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportRequest $request)
    {
        Support::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
