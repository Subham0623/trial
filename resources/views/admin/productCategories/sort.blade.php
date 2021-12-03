@extends('layouts.admin')

@section('styles')
    <!-- <link rel="stylesheet" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ url('sort/css/style.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Sort {{ trans('cruds.productCategory.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <!-- <div class="row"> -->
            <div class="col-md-12 dd" id="nestable-wrapper">
                <ol class="dd-list list-group">
                    @foreach($categories as $k => $category)
                        <li class="dd-item list-group-item" data-id="{{ $category['id'] }}" >
                            <div class="dd-handle" >{{ $category['name'] }}</div>
                            
                            @if(!empty($category->childCategories))
                                @include('admin.productCategories.sort_child', [ 'category' => $category])
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        <!-- </div> -->

        <div class="row">
            <form action="{{ route('admin.product-categories.save-nested-categories') }}" method="post">
                @csrf
                <textarea style="display: none;" name="nested_category_array" id="nestable-output"></textarea>
                <button type="submit" class="btn btn-success" style="margin-top: 15px;" >Save</button>
            </form>
        </div>
    </div>            
</div>
@endsection

@section('scripts')
    <!-- <script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
    defer
    ></script>
    <script src="{{ url('vendor/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"
    defer
    ></script> -->
    <script src="{{ url('sort/js/jquery.nestable.js') }}" defer></script>

    <script src="{{ url('sort/js/style.js') }}" defer></script>
@endsection