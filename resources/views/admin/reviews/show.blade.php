@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.review.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.id') }}
                        </th>
                        <td>
                            {{ $review->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.review') }}
                        </th>
                        <td>
                            {{ $review->review }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.type') }}
                        </th>
                        <td>
                        @if($review->type == 0)
                            Publisher
                        @else
                            Author
                        @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.status') }}
                        </th>
                        <td>
                            @if($review->status == 0)
                                Pending
                            @elseif($review->status == 1)
                                Approved
                            @else
                                Rejected
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.user') }}
                        </th>
                        <td>
                            {{ $review->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.product') }}
                        </th>
                        <td>
                            {{ $review->product->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </div>
                <div>
                
                
                <a class="btn btn-success" href="{{route('admin.reviews.approve',$review->id)}}">
                    Approve
                </a>
                <a class="btn btn-danger" href="{{route('admin.reviews.reject',$review->id)}}">
                    Reject
                </a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection