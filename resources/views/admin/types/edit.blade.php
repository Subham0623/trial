@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.type.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.types.update", [$type->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.type.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $type->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type.fields.title_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="type_id">{{ trans('cruds.type.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($types as $item)
                        @if($type->id !== $item->id)
                            <option value="{{ $item->id }}" {{ old('tyoe_id', $type->type_id) == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                            @foreach($item->childTypes as $childType)
                                @if($type->id !== $childType->id)
                                    <option value="{{ $childType->id }}" {{ old('type_id', $type->type_id) == $childType->id ? 'selected' : '' }}>-- {{ $childType->title }}</option>
                                        @foreach($childType->childTypes as $subType)
                                            @if($type->id !== $subType->id)
                                            <option value="{{ $subType->id }}" {{ old('type_id', $type->type_id) == $subType->id ? 'selected' : '' }}>--- {{ $subType->title }}</option>
                                            @endif
                                        @endforeach    
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type.fields.type_helper') }}</span>
            </div>
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default btn-close" href="{{ route("admin.types.index") }}">Cancel</a>

            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

@endsection
