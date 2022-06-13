@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Manage Access to Book
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table">
                <thead>Personal Details :</thead>
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            Institute
                        </th>
                        <td>
                            {!! $user->user_detail->institute !!}
                        </td>
                    </tr>                    
                    <tr>
                        <th>
                            Institute Contact 
                        </th>
                        <td>
                            {!! $user->user_detail->institute_contact !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Notes
                        </th>
                        <td>
                            {!! $user->user_detail->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>Manage Requests :</thead>
                    <tbody>
                        <tr>
                            <th>Teaching Level</th>
                            <th>Subject</th>
                            <th>Can Read Book</th>
                            <th>Action</th>
                        </tr>
                        @foreach($user->levels()->orderBy('level_id')->get() as $key => $level)
                        <tr>
                            <td>{!! $level->title !!}</td>
                            <td>{!! $user->tags[$key]->name !!}</td>
                            
                            @if($level->pivot->status == 0)
                                <td>
                                    <span class="badge badge-info">Pending</span>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.users.can-read-book', [$user,$level->id,$user->tags[$key]->id,1]) }}">
                                        Grant
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.users.can-read-book', [$user,$level->id,$user->tags[$key]->id,-1]) }}">
                                        Reject
                                    </a>
                                </td>
                            @elseif($level->pivot->status == 1)
                                <td> 
                                    <span class="badge badge-success">Yes</span>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('admin.users.can-read-book', [$user,$level->id,$user->tags[$key]->id,-1]) }}">
                                        Reject
                                    </a>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-danger">No</span>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.users.can-read-book', [$user,$level->id,$user->tags[$key]->id,1]) }}">
                                        Grant
                                    </a>
                                </td>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
        <h4>Add More Subjects</h4>
            <form method="POST" action="{{ route('admin.users.addMoreSubject', $user) }}" enctype="multipart/form-data">
                @csrf
                <div class="multi__select-container">
                    <div class="wrap">
                        <div class="form-group form__group">
                            <label
                            for="level"
                            class="form__label"
                            >Teaching Level*</label
                            >
                            <select
                            name="teaching_level[]"
                            id="level"
                            class="form-control form__input form__input--select level"
                            
                            >
                                <option value="">--Select level--</option>
                                @foreach($levels as $key => $level)
                                    <option value="{{$key}}">{{$level}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group form__group">
                            <label
                            for="subject"
                            class="form__label"
                            >Subject*</label
                            >
                            <select
                            name="subject-0[]"
                            id="subject"
                            class="form-control form__input form__input--select select2 specific__subject subject"
                            multiple
                            >
                                <option value="">--Select level first--</option>
                            </select>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="buttons-new" style="">
                    <button class="add-fields">Add</button>  
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- <script src="{{ asset('site/js/formmanipulate.js')}}" defer></script> -->
<script>
// adding new section for teaching level and subject
const addBtn = document.querySelector(".add-fields");
  const multiSelectContainer = document.querySelector(".multi__select-container");

  function getNumberId(){
      const allWrap = document.querySelectorAll('.wrap');
      const previousWrap = allWrap[allWrap.length - 1];
      const idElement = previousWrap.querySelector('.form__group select');
      const id = idElement.getAttribute('id');
      let matches = id.match(/(\d+)/);
      if (matches) {
        const number = +matches[0];
        return number;
      }
    
    return 0;
  }

  addBtn.addEventListener("click", function (e) {
    e.preventDefault();

    // get previous sibling
   let idNumber =  getNumberId();
    idNumber++;
    const addFields = `
        <div class="wrap">
          <div class="form__group">
            
            <label
              for="level-${idNumber}"
              class="form__label"
              >Teaching Level*</label
            >
            <select
              name="teaching_level[]"
              id="level-${idNumber}"
              class="form-control form__input form__input--select level"
              required
            >
              <option value="" disabled selected>--Select level--</option>
              
              @foreach($levels as $key => $level)
                  <option value="{{$key}}">{{$level}}</option>
              @endforeach
            </select>
          </div>
          <div class="form__group">
                  
              <label
              for="subject-${idNumber}"
              class="form__label"
              >Subject*</label
              >
              <select
              name="subject-${idNumber}[]"
              class="mul-select form__input form__input--select specific__subject subject"
              multiple="true"
              id="subject-${idNumber}"
              required
              >
              <option value="">--Select level first--</option>
              
              </select>
          </div>
          <button class="delete__div">Delete</button>
        </div>
      `;
      multiSelectContainer.insertAdjacentHTML("beforeend", addFields);
      

      $(document).ready(function () {
          $(".mul-select").select2({
              placeholder: "", //placeholder
              tags: true,
              tokenSeparators: ["/", ",", ";", " "],
          });
      });
    });

  multiSelectContainer.addEventListener('click', function(e){
    const parent = e.target.closest('.wrap');
    if(!parent) return;
    const requireElement = e.target.closest('.form__input');
    if(!requireElement) return;
    const subjectElement = parent.querySelector('.specific__subject');

    const myId = requireElement.getAttribute('id');
    const subjectId = subjectElement.getAttribute('id');
    
    $(document).off('change',`#${myId}`).on('change', `#${myId}`, function() {
      // Code here...
      $.get('{{ route('levels.getSpecificTags') }}',
        { 'level_id': $(this).val() },
        function( data ) {
          $(`#${subjectId}`).empty();
          $tags = '<option value="">Please select tags</option>';
          for (var i in data) {
            $tags+='<option value="'+i+'" >'+data[i]+'</option>';
          }
          $(`#${subjectId}`).append($tags);
        }
      );
    });
    // $(`#${myId}`).unbind('change').change(function(e){
    //   $.get('{{ route('levels.getSpecificTags') }}',
    //     { 'level_id': $(this).val() },
    //     function( data ) {
    //       $(`#${subjectId}`).empty();
    //       $tags = '<option value="">Please select tags</option>';
    //       for (var i in data) {
    //         $tags+='<option value="'+i+'" >'+data[i]+'</option>';
    //       }
    //       $(`#${subjectId}`).append($tags);
    //     }
    //   );
    // });
  });


  function change(parent){
    const editingElements = [];

    let nextSibling = parent.nextElementSibling;

    
    while(nextSibling) {
      // console.log('element got', nextSibling);
      // editingElements.push(nextSibling);
      const changeElementLabel = nextSibling.querySelectorAll('.form__group label');

      // get number
      const idElement = changeElementLabel[0];
      const id = idElement.getAttribute('for');
      console.log(id);
      let matches = id.match(/(\d+)/);
      let number;
      if (matches) {
        number = +matches[0];
        console.log('got', number);
        number--;
      }

      changeElementLabel.forEach( element=>{
        const labelName = element.getAttribute('for').split('-')[0];

        // console.log(labelName);
        element.setAttribute('for',`${labelName}-${number}`);
      })

      const changeElementSelect = nextSibling.querySelectorAll('.form__group select');

      changeElementSelect.forEach( element =>{
        
        const idName = element.getAttribute('id').split('-')[0];

        if(element.classList.contains('mul-select')){
          let name = element.getAttribute('name').split('-')[0];
          element.setAttribute('name',`${name}-${number}[]`);
          
        }
        // console.log(labelName);
        element.setAttribute('id',`${idName}-${number}`);
      })
      console.log(changeElementLabel, changeElementSelect);

      nextSibling = nextSibling.nextElementSibling;


    }
    
    console.log(editingElements);
  }

  document.body.addEventListener("click", function (e) {
    // console.log("am here");
    if (e.target.className == "delete__div") {
        //
        e.preventDefault();

        const catchParent = e.target.closest(".wrap");
        // console.log(catchParent);

        // function to change all the remaining id number
        change(catchParent);

        catchParent.remove();
    }
});

    
</script>
@endsection