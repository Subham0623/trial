<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubjectAreaRequest;
use App\Http\Requests\UpdateSubjectAreaRequest;
use App\Http\Requests\MassDestroySubjectAreaRequest;
use Gate;
use App\SubjectArea;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SubjectAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('subject_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject_areas = SubjectArea::orderBy('sort')->get();

        return view('admin.subjectareas.index', compact('subject_areas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('subject_area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


            $subject_area = SubjectArea::latest()->first();
            $sort = ($subject_area)?$subject_area->sort + 5:1;

        // dd($sort);
        return view('admin.subjectareas.create',compact('sort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectAreaRequest $request)
    {
        $data = [
            'title' => $request->title,
            'sort' => $request->sort,
            'status' => $request->status,
        ];

        $subject_area = SubjectArea::create($data);

        return redirect()->route('admin.subject-areas.index')->with('message','New Subject Area added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectArea $subject_area)
    {
        abort_if(Gate::denies('subject_area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subjectareas.show', compact('subject_area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectArea $subjectArea)
    {
        abort_if(Gate::denies('subject_area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subjectareas.edit', compact('subjectArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectAreaRequest $request, SubjectArea $subject_area)
    {
        // dd($request->all());
        $data = [
            'title' => $request->title,
            'sort' => $request->sort,
            'status' => $request->status,
        ];

        $subject_area->update($data);

        return redirect()->route('admin.subject-areas.index')->with('message','Subject Area details edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectArea $subject_area)
    {
        abort_if(Gate::denies('subject_area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject_area->delete();

        return back()->with('message','Subject Area deleted successfully!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(SubjectArea::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);

    }

    public function massDestroy(MassDestroySubjectAreaRequest $request)
    {
        SubjectArea::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function changeStatus(Request $request)
    {
        abort_if(Gate::denies('subject_area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjectArea = SubjectArea::find($request->subjectArea_id);
        $subjectArea->status = $request->status;
        $subjectArea->save();

        return response()->json(['success'=>'Status changed successfully.']);
    }
}
