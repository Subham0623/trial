@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.framework') }}
                        </th>
                        <td>
                            {{ $product->framework }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.published_date') }}
                        </th>
                        <td>
                            {{ $product->published_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.featured') }}
                        </th>
                        <td>
                            @if($product->featured==1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <td>
                            @foreach($product->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tag') }}
                        </th>
                        <td>
                            @foreach($product->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.author') }}
                        </th>
                        <td>
                            @foreach($product->authors as $key => $author)
                                <span class="label label-info">{{ $author->name }}</span>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.license') }}
                        </th>
                        <td>
                            @foreach($product->licenses as $key => $license)
                                <span class="label label-info">{{ $license->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <td>
                            @foreach($product->licenses as $key => $license)
                                <span class="label label-info">{{ $license->pivot->price }}({{$license->name}})</span><br>
                            @endforeach
                        </td>
                    </tr>
                   
                    
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.photo') }}
                        </th>
                        <td>
                            @if($product->photo)
                                <a href="{{ $product->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $product->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.slug') }}
                        </th>
                        <td>
                            {{ $product->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.overview') }}
                        </th>
                        <td>
                            {!! $product->productdetail->overview !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.features') }}
                        </th>
                        <td>
                            {!! $product->productdetail->features !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.requirements') }}
                        </th>
                        <td>
                            {!! $product->productdetail->requirements !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.instructions') }}
                        </th>
                        <td>
                            {!! $product->productdetail->instructions !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection