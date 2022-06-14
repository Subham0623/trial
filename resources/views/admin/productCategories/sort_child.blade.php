@if(!empty($category->childCategories))
    <ol class="dd-list list-group">
        @foreach($category->childCategories as $kk => $sub_category)
            <li class="dd-item list-group-item" data-id="{{ $sub_category['id'] }}" >
                <div class="dd-handle" >{{ $sub_category['name'] }}</div>
                

                @include('admin.productCategories.sort_child', [ 'category' => $sub_category])
            </li>
        @endforeach
    </ol>
@endif