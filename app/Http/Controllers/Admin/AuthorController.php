<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuthorRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Gate;
use App\Author;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;


class AuthorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('author_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = Author::all();

        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        abort_if(Gate::denies('author_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->all());
        

        if ($request->input('photo', false)) {
            $author->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $author->id]);
        }
        
        return redirect()->route('admin.authors.index');

    }

    public function edit(Author $author)
    {
        abort_if(Gate::denies('author_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.authors.edit',compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->all());
        

        if ($request->input('photo', false)) {
            if (!$author->photo || $request->input('photo') !== $author->photo->file_name) {
                $author->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($author->photo) {
            $author->photo->delete();
        }
        
        return redirect()->route('admin.authors.index');

    }

    public function show(Author $author)
    {
        abort_if(Gate::denies('author_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.authors.show', compact('author'));
    }

    public function destroy(Author $author)
    {
        abort_if(Gate::denies('author_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $author->delete();

        return back();

    }

    public function massDestroy(MassDestroyAuthorRequest $request)
    {
        Author::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('author_create') && Gate::denies('author_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Author();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Author::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }
}
