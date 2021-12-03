<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLevelRequest;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Level;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ProductTag;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levels = Level::all();

        return view('admin.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tags = ProductTag::all()->pluck('name', 'id');
        return view('admin.levels.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLevelRequest $request)
    {
        $level = Level::create($request->all());
        $level->tags()->sync($request->input('tags', []));
        return redirect()->route('admin.levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        abort_if(Gate::denies('level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        abort_if(Gate::denies('level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $level = $level->load('tags');
        $tags = ProductTag::all()->pluck('name', 'id');
        return view('admin.levels.edit', compact('level','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevelRequest $request, Level $level )
    {
        $level->update($request->all());
        $level->tags()->sync($request->input('tags', []));
        return redirect()->route('admin.levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->delete();

        return back();
    }

    public function massDestroy(MassDestroyLevelRequest $request)
    {   
        Level::whereIn('id', request('ids'))->delete(); 

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function getSpecificTags(Request $request) {
        $tags = ProductTag::whereHas('levels', function ($query) use ($request) {
            $query->where('level_id', $request->level_id);
        })
        ->pluck('name','id');
        return $tags;
    }
}
