@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('checkbox/checkbox.css')}}">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.update", [$role->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            @if(auth()->user()->isMainAdmin)
            <div class="form-group">
                <label class="" for="can_shareable">{{ trans('cruds.role.fields.can_shareable') }}</label>
                <div class="form-check">
                    <input class="form-check-input {{ $errors->has('can_shareable') ? 'is-invalid' : '' }}" type="radio" name="can_shareable" id="can_shareable" value="{{ old('can_shareable', '1') }}" {{$role->can_shareable==1?'checked':''}}>
                    <label class="form-check-label" for="inlineRadio2">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input {{ $errors->has('can_shareable') ? 'is-invalid' : '' }}" type="radio" name="can_shareable" id="can_shareable" value="{{ old('can_shareable', '0') }}" {{$role->can_shareable==0?'checked':''}}> 
                    <label class="form-check-label" for="inlineRadio2">No</label>
                </div>
                    @if($errors->has('can_shareable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('can_shareable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.can_shareable_helper') }}</span>
            </div>
            @endif
            {{--<div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
            </div>--}}

            <div class="form-group">
                <div class="check__box-heading">
                <label class="required">Grant Permissions</label>
                    @if($errors->has('permissions'))
                        <div class="invalid-feedback">
                            {{ $errors->first('permissions') }}
                        </div>
                    @endif
                    <div class="check__box-design">
                        <div class="check__box-container">
                            @foreach($groups as $key => $group)
                                @if($group->group_permission->count())
                                <div class="check__box-container-{{$key}}">
                                    <div class="check__all-design">
                                        <label for="checkAll-{{$key}}">{{$group->title}}</label>
                                        <input
                                        type="checkbox"
                                        class="check__all"
                                        id="checkAll-{{$key}}"
                                        data-checkall-trigger="group{{$key}}"
                                        />
                                        <label class="check__all-box" for="checkAll-{{$key}}">
                                        <div class="state unchecked active-state"></div>
                                        <div class="state checked">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            enable-background="new 0 0 24 24"
                                            id="Layer_1"
                                            version="1.0"
                                            viewBox="0 0 24 24"
                                            xml:space="preserve"
                                            >
                                            <polyline
                                                class="path"
                                                fill="none"
                                                points="20,6 9,17 4,12"
                                                stroke="#000000"
                                                stroke-miterlimit="10"
                                                stroke-width="2"
                                            />
                                            </svg>
                                        </div>
                                        <div class="state some__checked"></div>
                                        </label>
                                    </div>
                                    <div
                                        class="child__box-container child__box-container-{{$key}}"
                                        data-checkbox-tab="{{$key}}"
                                        >
                                        @foreach($group->group_permission as $k => $permission)
                                        <div class="child__box">
                                            <input
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                id="cb{{$key}}-{{$k}}"
                                                data-checkall-group="group{{$key}}"
                                                
                                                {{ (in_array($permission->id, old('permissions', [])) || $role->permissions->contains($permission->id)) ? 'checked' : '' }}
                                                
                                            />
                                            <label for="cb{{$key}}-{{$k}}" id="checkbox">
                                                <svg viewBox="0 0 100 100">
                                                <path
                                                    class="box"
                                                    d="M82,89H18c-3.87,0-7-3.13-7-7V18c0-3.87,3.13-7,7-7h64c3.87,0,7,3.13,7,7v64C89,85.87,85.87,89,82,89z"
                                                />
                                                <polyline
                                                    class="check"
                                                    points="25.5,53.5 39.5,67.5 72.5,34.5 "
                                                />
                                                </svg>
                                                <span>{{$permission->title}}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default btn-close" href="{{ route("admin.roles.index") }}">Cancel</a>

            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    <script src="{{ asset('checkbox/checkbox.js')}}"></script>
@endsection