<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Form;
use App\SubjectArea;
use App\Parameter;
use App\Option;
use App\Organization;
use App\Models\Authorization\User\User;
use App\FormDetail;
use App\FormSubjectArea;
use Illuminate\Http\Request;
use DB;

class HomeApiController extends Controller
{
    public function form()
    {
        dd(Option::all()->load('formSubjectAreas.feedbacks'));
        dd($user = Auth::user()->load('forms.subjectAreas.options'));
        $selected_options = [];
        
        if($user->forms()->exists()) {
            $form = $user->forms()->latest()->first();
            $selected_options = $form->options()->pluck('option_id');
            
            // $subject_areas = SubjectArea::with(['parameters.options' => function ($query) use ($selected_options) {
            //     $query->find($selected_options)->each->setAttribute('status',true);
            //     $query->whereNotIn('id', $selected_options)->get()->each->setAttribute('status',false);
            // }])
            // ->get();
        }
        
        $subject_areas = SubjectArea::with('parameters.options','parameters.documents')->get();
        
        return response([
            'subject_areas' => $subject_areas,
            'selected_options' => $selected_options,
        ]);
    }

    public function profile()
    {
        $user = Auth::user()->with('roles.permissions','organization')->get();
        return response(['user'=>$user]);
    }

    public function store(Request $request)
    {
        dd($request->all());
// dd(json_encode($a,true));
return response()->json($a);
// $result = $request->all();
// $ans = '
//         "sujectareas" : 
        
//             {
//                 "id":"3",
//                 "parameters":
//                 [{
//                     "3" : 
//                     {
//                         "option" : "3"
//                     },

//                     "4":
//                     {
//                         "option" : "7"
//                     }
//                 }]

//             }
        
// ';

// subjectareas[0]['parameters]['6']

// $ans = '
//     "subjectarea" : 
//     {
//         "id": "3"
//     }
// ';
// $subjectarea = json_decode($ans,true);
// dd($subjectarea);

$string = '

{
    "subjectarea": 
        {
            "id": 1,
            "parameters":
            [{
                "id":1,
                "remarks": "this is remarks",
                "option": 
                    {
                        "id": 1
    
                    }
                
            },
            {
                "id":2,
                "remarks": "this is another remarks",
                "option": 
                    {
                        "id": 3
    
                    }
                
            }
            ]
        }
    
}

';


// dd($result);
// foreach($result as $r)
// {
    
//     dd($r);
// }
// $result = '
// {
//     "3": {
//         "option": 3,
//         "documents": {
//             "4": "File",
//             "5": "File"
//         }
//     },
//     "4": {
//         "option": "",
//         "documents": {}
//     },
//     "5": {
//         "option": "",
//         "documents": {}
//     }
// }
// ';

// $areas = json_decode($result, true);
//     dd($area);
    $subjectarea = json_decode($string, true);
    dd($subjectarea);
    $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'year' => $request->year,
        ];

        $form = Form::create($data);
        // dd($form);

        foreach($areas as $area )
        {
            dd($area);
            $form_subject_area = FormSubjectArea::create([
                'form_id' => $form->id,
                'subject_area_id' => $area['id'],
            ]);
            
            ;

            foreach($area['parameters'] as $parameters)
            {
                // dd($parameters['remarks']);
                foreach($parameters['option'] as $option)
                {
                    $opt = Option::find($option)->first();
                    $option = FormDetail::create([
                        'form_subject_area_id' => $form_subject_area->id,
                        'option_id' => $option,
                        'remarks' => $parameters['remarks'],
                        'marks' => $opt->points,
                    ]);

                    
                    
                }
            }
            // dd($area['parameters']);
            
           $total = $form_subject_area->options->sum('pivot.marks');
           $form_subject_area->update([
               'marks'=> $total
           ]);
        }




            
            


        

        // $form = Form::findOrFail($request->id)->with('user')->first();
        
        // if(isset($form)){
        //     foreach($options as $option)
        //     {
        //         $data = [
        //             $form_id = $form->id,
        //             $option_id = $option->id,
        //         ];
                 
        //         $form_option = FormDetail::create($data);
            

        //     }
        // }

        // $data = [
        //     'user_id' => Auth::user()->id,
        //     // 'organization_id' => Auth::user()->organization()->id,
        //     'year' => $request->year,

        // ];

        // $form = Form::create($data);

        // $data = [
        //     'form_id' => $form->id,
        // ];
        return response(['message'=>'Form saved successfully']);
    }

    public function fileUpload(Request $request)
    {
        // dd($request->file('file'));
        // $uploaded_file = $request->file('file')->store('tmp/documents/');
        // return response(['result'=>$uploaded_file]);
        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $path = storage_path('tmp/documents');
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function test(Request $request)
    {
        // dd($request->all());
        $form = Form::findOrFail($request->id)->where('user_id',Auth::user()->id)->first();
        $form_options = $form->options()->pluck('option_id');


        
            // $parameters = Parameter::where(['options'=>function($query) use($form_options){
            //     $query->whereIn('id',$form_options)->put('status',true);
            // }])->with('options')->get();
        
        // dd($options);
        // $subject_areas = SubjectArea::with(['parameters.options'=>function($query) use($form_option){
        //        $query->where('id',$form_option);
        //     }])->get();
        
            // $options = Option::where('id',1)->put('status',1);

        
        // dd($options);
        // 


        $parameters = Parameter::whereHas('options',function($query) use($form_options){
            $query->whereIn('id',$form_options);
        })->with('options')->get()->put('status',1);

        
        return response(['parameters' => $parameters]);
    }
}
