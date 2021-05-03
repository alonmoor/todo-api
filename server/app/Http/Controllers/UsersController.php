<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Task;
use App\Models\TaskUser;
use Validator;
use Illuminate\Support\Facades\Auth;
//use DataTables;
//https://www.youtube.com/watch?v=376vZ1wNYPA-
class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Sample_data::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($form_data='')
    {
//        $task = new Task();
//
//        $task->id = $form_data['task_id'];
//        $task->save();
//
//        $users = $form_data[$userids];
//        $task->users()->sync($users);
//
//        return redirect()->route('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $arr_input = $request->task_id;
        if (is_array($arr_input) && count($arr_input) > 0) {
            foreach ($arr_input as $task) {
                if ($task['name'] == 'task_id_hidden') {
                    $task_id = $task['value'];
                    break;
                }
            }
        }
        if (is_array($request->data) && count($request->data) > 0) {
            foreach ($request->data as $user) {

                $id = explode('_', $user);
                $id = $id['1'];
                $userids [] = $id;
            }
        }

        $rules = array(

            'data'    =>  'required',
            'task_id'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'user_id'        =>  $userids,
            'task_id'         =>  $task_id
        );

        $task = Task::find($form_data['task_id']);

        $intArray = array_map(
            function($value) { return (int)$value; },
            $userids
        );

        $request->validate([

        ]);

        $task->users()->syncWithoutDetaching($intArray);

        $task->users()->sync($intArray);

        if (Auth::user()) {   // Check is user logged in
            return redirect()->route('/home');
        } else {
            return redirect()->route('/');
        }

        //   return response()->json(['success' => 'Data Added successfully.']);

    }







//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index(Request $request)
//    {
//        if($request->ajax())
//        {
//            $data = Sample_data::latest()->get();
//            return DataTables::of($data)
//                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
//                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
//                    return $button;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//        return view('sample_data');
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $x = 1;
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $rules = array(
//            'first_name'    =>  'required',
//            'last_name'     =>  'required'
//        );
//
//        $error = Validator::make($request->all(), $rules);
//
//        if($error->fails())
//        {
//            return response()->json(['errors' => $error->errors()->all()]);
//        }
//
//        $form_data = array(
//            'first_name'        =>  $request->first_name,
//            'last_name'         =>  $request->last_name
//        );
//
//        Sample_data::create($form_data);
//
//        return response()->json(['success' => 'Data Added successfully.']);
//
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\User $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $sample_data)
//    {
//        $x = 1;
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        if(request()->ajax())
//        {
//            $data = Sample_data::findOrFail($id);
//            return response()->json(['result' => $data]);
//        }
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Sample_data $sample_data)
//    {
//        $rules = array(
//            'first_name'        =>  'required',
//            'last_name'         =>  'required'
//        );
//
//        $error = Validator::make($request->all(), $rules);
//
//        if($error->fails())
//        {
//            return response()->json(['errors' => $error->errors()->all()]);
//        }
//
//        $form_data = array(
//            'first_name'    =>  $request->first_name,
//            'last_name'     =>  $request->last_name
//        );
//
//        Sample_data::whereId($request->hidden_id)->update($form_data);
//
//        return response()->json(['success' => 'Data is successfully updated']);
//
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\User  $sample_data
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $data = Sample_data::findOrFail($id);
//        $data->delete();
//    }






















//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $x =1;
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $x =1;
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $user = User::create([ //dont need the save method -> pass an array in the model
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'password' => $request->input('password')
//           ]);
//
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //$users = User::all();
//        $user = User::find($id);
//    //    var_dump($user->tasks);
//        return view('users.edit')->with('user',$user);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $x =1;
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//   {
//       $x =1;
//
////        $user = User::where('id', $id)->update([ //dont need the save method -> pass an array in the model
////            'name' => $request->input('name'),
////            'founded' => $request->input('founded'),
////            'description' => $request->input('description')
////        ]);
////
////        return redirect('/cars');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $x =1;
//    }



//
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $users = User::latest()->paginate(5);
//        return view('users.index',compact('users'))->with('i',(request()->input('page',1)-1)*5);
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        return view('users.create');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
////        $request->validate([
////            'name' => 'required',
////            'description' => 'required',
////        ]);
//
//    //    User::create($request->all());
//
//
//            $user = User::create([
//            'task_id' => $request->input('task_id_hidden'),
//            'user_id' => $request->input('user_checkbox')
//            //'password' => $request->input('password')
//           ]);
//
//
//        return redirect()->route('users.index')
//            ->with('success','User created successfully.');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $user)
//    {
//        return view('users.show',compact('user'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(User $user)
//    {
//        return view('users.edit',compact('user'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, User $user)
//    {
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//        ]);
//
//        $user->update($request->all());
//
//        return redirect()->route('users.index')
//            ->with('success','User updated successfully');
//    }
//
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(User $user)
//    {
//        $user->delete();
//
//        return redirect()->route('users.index')
//            ->with('success','Users deleted successfully');
//    }












}
