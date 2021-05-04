<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Task;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTablesServiceProvider;
use DataTables;
use Validator;
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
            $data = TaskUser::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            $tasks = Task::with('users')->get();
            return view('home')->with('tasks',$tasks);;
            return view('welcome');
        }else{
            $tasks = Task::with('users')->get();
            return view('home')->with('tasks',$tasks);;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($form_data='')
    {

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

//        $task->users()->detach([
//            1=> [
//                'status' => 'approved'
//            ]
//        ]);
//
//        $task->users()->sync([
//            2=> [
//                'status' => 'approved'
//            ]
//        ]);

       // $task->users()->syncWithoutDetaching($intArray);


        $users = User::all();
        $tasks = Task::with('users')->get();
        $task->users()->sync($intArray);


        //    $task->users()->sync($intArray);
        $users = User::all();
        $tasks = Task::with('users')->get();
        if (Auth::user()) {
            return redirect()->route('users.index');
            return view('users.index')->with('users',$users);;
            //return redirect()->route('/users');
             return redirect('/home')->with('tasks',$tasks);
            //   return redirect()->route('/home')->with('tasks',$tasks);
        } else {
       //    return view('users.home')->with('tasks',$tasks);;

            return redirect()->route('users.index');
            return redirect('/home')->with('users',$users)->with('tasks',$tasks);
            return view('users.index')->with('users',$users);
          //  return redirect()->route('/home')->with('tasks',$tasks);
        }



        //   return response()->json(['success' => 'Data Added successfully.']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $sample_data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Sample_data::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskUser $sample_data)
    {
        $rules = array(
            'user_id'        =>  'required',
            'task_id'         =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'first_name'    =>  $request->first_name,
            'last_name'     =>  $request->last_name
        );

        TaskUser::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TaskUser::findOrFail($id);
        $data->delete();
    }



}
