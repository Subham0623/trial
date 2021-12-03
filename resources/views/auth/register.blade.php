@extends('layouts.website')

@section('styles')
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"
  />
  <link rel="stylesheet" href="{{ asset('site/css/login.css')}}" />
@endsection

@section('content')
  <section class="section-log">
    <div class="row-log">
      <div class="brandLogo">
        <img src="{{ asset('site/img/asmita.png')}}" alt="" />
      </div>
      <div class="logIn__form">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          @csrf
         
          @if ($errors->any())
          
    		<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                	<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif
          
          <div class="form__group">
            <input
              type="text"
              class="form__input"
              placeholder="Full Name*"
              id="firstName"
              name="name"
              required
            />
            <label for="firstName" class="form__label">Full Name*</label>

          </div>

          <div class="form__group">
            <input
              type="email"
              class="form__input"
              placeholder="Email Address*"
              id="email"
              name="email"
              required
            />
            <label for="email" class="form__label">Email Address*</label>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form__group">
            <input
              type="number"
              class="form__input"
              placeholder="Phone Number*"
              id="phoneNumber"
              name="contact"
              oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              maxlength="10"
              required
            />
            <label for="phoneNumber" class="form__label">Phone Number*</label>
          </div>

          <div class="form__group">
            <input
              type="password"
              class="form__input"
              placeholder="Password*"
              id="password"
              name="password"
              required
            />
            <label for="password" class="form__label">Password*</label>
          </div>

          <div class="form__group">
            <input
              type="password"
              class="form__input"
              placeholder="Confirm Password*"
              id="confirmPassword"
              name="password_confirmation"
              required
            />
            <label for="confirmPassword" class="form__label"
              >Confirm Password*</label
            >
          </div>

          <div class="form__group">
            <?php 
              $roles = \App\Role::whereIn('id', [2,3])->get();
            ?>
            <select
              name="role"
              id="role"
              class="form__input form__input--select"
              style="color: #999"
              required
            >
              <option value="" disabled selected>Select Role*</option>
              @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->title}}</option>
              @endforeach
            </select>
            <label
              for="role"
              class="form__label select-effect select-label__hide"
              >Select Role*</label
            >
          </div>

          <!-- hidden form show only for teacher -->

          <div class="hide--form">
            <div class="form__group">
              <input
                type="file"
                class="form__input"
                placeholder="ID Card*"
                id="card"
                name="card"
              />
              <label for="card" class="form__label"
                >ID Card*</label
              >
            </div>
            <!-- <div class="multi__select-container">
              <div class="wrap">
                <div class="form__group">
                  
                  <label
                    for="level"
                    class="form__label"
                    >Teaching Level*</label
                  >
                  <select
                    name="teaching_level[]"
                    id="level"
                    class="form__input form__input--select level"
                    
                  >
                    <option value="" disabled selected></option>
                   
                  </select>
                </div>

                <div class="form__group">
                  <?php 
                    $subjects = \App\ProductTag::all();
                  ?>
                  <label
                    for="subject"
                    class="form__label"
                    >Subject*</label
                  >
                  <select
                    name="subject-0[]"
                    class="mul-select form__input form__input--select specific__subject subject"
                    multiple="true"
                    id="subject"
                  >
                    <option value="" disabled>Subject*</option>
                    
                  </select>
                  
                </div>
              </div>
            </div>
             
            <div class="buttons-new" style="margin-top: -4.5rem;
                  text-align: end;
                  margin-bottom: 3rem;
                  position: relative;">
                <button class="add-fields">Add</button>  
            </div> -->

            <div class="form__group">
              <input
                type="text"
                class="form__input"
                placeholder="College/ School Name*"
                id="instituteName"
                name="institute"
                
                
              />
              <label for="instituteName" class="form__label"
                >College/ School Name*</label
              >
            </div>

            <div class="form__group">
              <input
                type="text"
                class="form__input"
                placeholder="Principal Name"
                id="principalName"
                name="institute_principal"
                
              />
              <label for="principalName" class="form__label"
                >Principal Name</label
              >
            </div>

            <div class="form__group">
              <input
                type="number"
                class="form__input"
                placeholder="College/ School Contact"
                id="instituteNumber"
                name="institute_contact"
                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                maxlength="10"
                
              />
              <label for="instituteNumber" class="form__label"
                >College/ School Contact</label
              >
            </div>

            <div class="form__group">
              <select
                name="institute_province"
                id="province"
                class="form__input form__input--select"
                style="color: #999"
              >
                <option value="" selected>Provience</option>
                <option value="1">Provience 1</option>
                <option value="2">Provience 2</option>
                <option value="3">Provience 3</option>
                <option value="1">Provience 4</option>
                <option value="2">Provience 5</option>
              </select>
              <label
                for="role"
                class="form__label select-effect select-label__hide"
                >Provience</label
              >
            </div>

            <!-- 1. side by side input field -->

            <div class="group__input--field">
              <div class="form__group">
                <input
                type="text"
                class="form__input"
                placeholder="Municipality"
                name="institute_muncipality"
                id="municipality"
                
              />
                 
                
                <label
                  for="municipality"
                  class="form__label"
                  >Municipality</label
                >
              </div>

              <div class="form__group">
              <input
                type="text"
                class="form__input"
                placeholder="District"
                name="institute_district"
                id="district"
                
              />
              
                <label
                  for="district"
                  class="form__label "
                  >District</label
                >
              </div>
            </div>

            <!-- 2. side by side input field -->
            <div class="group__input--field">
              <div class="form__group">
                <input
                  type="number"
                  class="form__input"
                  placeholder="Ward Number"
                  id="ward"
                  name="institute_ward"
                  oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  maxlength="3"
                  
                />
                <label
                  for="ward"
                  class="form__label select-effect"
                  >Ward Number</label
                >
              </div>

              <div class="form__group">
                <input
                  type="text"
                  class="form__input"
                  placeholder="Street Name"
                  id="street"
                  name="institute_street_name"
                  
                  
                />
                <label
                  for="street"
                  class="form__label"
                  >Street Name</label
                >
              </div>
            </div>

            
            <div class="form__group text__area-form-group">
              
              <textarea
                class="form__input" placeholder="Notes"
                id="notes"
                name="notes"
                rows="10"
              ></textarea>
              <label
                for="notes"
                class="form__label text__area-label"
                >Notes</label
              >
            </div>
          </div>
          
          <div class="form__group align-end">
            <p>* required fields</p>
          </div>

          <div class="form__group align-center">
            <input type="submit" class="btn__log btn--log" value="Register" />
          </div>

          <div class="form__group">
            <div class="other--option">
              <ul class="options__links">
                <li>
                  <a href="{{ route('login') }}">
                    <span class="icon-2"
                      ><i class="fas fa-arrow-right"></i
                    ></span>
                    <span class="effect">Log In</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('index') }}">
                    <span class="icon-2"
                      ><i class="fas fa-arrow-right"></i
                    ></span>
                    <span class="effect">Home</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
@endsection
 
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('site/js/formmanipulate.js')}}" defer></script>
<script>
  $(document).ready(function () {
    $(".mul-select").select2({
      placeholder: "", //placeholder
      tags: true,
      tokenSeparators: ["/", ",", ";", " "],
    });
    
    $("#role").change(function(){
      var option = $(this).val();
      if(option == 3){
        // $(".level").prop("required",true);
        // $(".subject").prop("required",true);
        $("#card").prop("required",true);
        $("#instituteName").prop("required",true);
        // $("#principalName").prop("required",true);
        // $("#instituteNumber").prop("required",true);
        // $("#province").prop("required",true);
        // $("#municipality").prop("required",true);
        // $("#district").prop("required",true);
        // $("#ward").prop("required",true);
        // $("#street").prop("required",true);

      }
      else{
        // $(".level").prop("required",false);
        // $(".subject").prop("required",false);
        $("#card").prop("required",false);
        $("#instituteName").prop("required",false);
        // $("#principalName").prop("required",false);
        // $("#instituteNumber").prop("required",false);
        // $("#province").prop("required",false);
        // $("#municipality").prop("required",false);
        // $("#district").prop("required",false);
        // $("#ward").prop("required",false);
        // $("#street").prop("required",false);
      }
    });
  });
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

if(addBtn){
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
              class="form__input form__input--select level"
              required
            >
              <option value="" disabled selected></option>
              
              
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
              <option value="" disabled>Subject*</option>
              
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
}


if(multiSelectContainer){

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

}
  

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