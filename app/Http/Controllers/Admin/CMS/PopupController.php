<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\CMS\Popup\MassDestroyPopupRequest;
use App\Http\Requests\CMS\Popup\StorePopupRequest;
use App\Http\Requests\CMS\Popup\UpdatePopupRequest;
use Gate;
use App\Models\CMS\Popup;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PopupController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('popup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $popups = Popup::all();

        return view('admin.popups.index', compact('popups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('popup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.popups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePopupRequest $request)
    {
        $popup = Popup::create($request->all());
        

        if ($request->input('photo', false)) {
            $popup->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $popup->id]);
        }
        
        return redirect()->route('admin.popups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Popup $popup)
    {
        abort_if(Gate::denies('popup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.popups.show', compact('popup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Popup $popup)
    {
        abort_if(Gate::denies('popup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.popups.edit',compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePopupRequest $request, Popup $popup)
    {
        $popup->update($request->all());
        

        if ($request->input('photo', false)) {
            if (!$popup->photo || $request->input('photo') !== $popup->photo->file_name) {
                $popup->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($popup->photo) {
            $popup->photo->delete();
        }
        
        return redirect()->route('admin.popups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Popup $popup)
    {
        abort_if(Gate::denies('popup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $popup->delete();

        return back();
    }

    public function massDestroy(MassDestroyPopupRequest $request)
    {
        Popup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('popup_create') && Gate::denies('popup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Popup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }
}
