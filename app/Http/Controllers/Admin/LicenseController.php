<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLicenseRequest;
use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use Gate;
use App\License;
use Illuminate\Http\Request;
// use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;


class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('license_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $licenses = License::all();

        return view('admin.licenses.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('license_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.licenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLicenseRequest $request)
    {
        $license = License::create($request->all());
        
        return redirect()->route('admin.licenses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        abort_if(Gate::denies('license_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.licenses.show', compact('license'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        abort_if(Gate::denies('license_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.licenses.edit',compact('license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLicenseRequest $request, License $license)
    {
        $license->update($request->all());
        
        return redirect()->route('admin.licenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        abort_if(Gate::denies('license_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $license->delete();
        // dd($license);

        return back();
    }

    public function massDestroy(MassDestroyLicenseRequest $request)
    {
        License::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(License::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }
}
