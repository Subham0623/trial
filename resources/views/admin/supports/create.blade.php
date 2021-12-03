@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.support.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.supports.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="product">{{ trans('cruds.support.fields.product') }}</label>
                <select name="product_id" id="" class="form-control">
                    <option value="">Select product</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}} {{ old('$product->id') ? 'selected' : '' }}">{{$product->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('product_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.product_helper') }}</span>
            </div>

            

            <div class="form-group">
                <label class="required" for="details">{{ trans('cruds.support.fields.details') }}</label>
                <textarea class="form-control" id="editor2" name="details"></textarea>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.details_helper') }}</span>
            </div>

            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

<script>

        ClassicEditor
        .create( document.querySelector( '#editor2' ))
        .catch( error => {
            console.error( error );
        } );
    


</script>


@endsection
