<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Book;
use Gate;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\MassDestroyBookRequest;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    use MediaUploadingTrait;
    public function index()
    {
        abort_if(Gate::denies('book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->all());
        if ($request->book) {
            $book->addMediaFromRequest('book')->toMediaCollection('book');
        }
        return redirect()->route('admin.books.index');
    }

    public function show(Book $book)
    {
        abort_if(Gate::denies('book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        abort_if(Gate::denies('book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.books.edit', compact('book'));
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->all());
        if ($request->book) {
            if($book->getFirstMedia('book')){
                $book->getFirstMedia('book')->delete();
            }
            $book->addMediaFromRequest('book')->toMediaCollection('book');
        }

        return redirect()->route('admin.books.index');
    }

    public function destroy(Book $book)
    {
        abort_if(Gate::denies('book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookRequest $request)
    {
        Book::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
