<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Category;
use App\User;
use Carbon\Carbon;

class UserDetailsController extends Controller
{

public function index()
    {
      $users = User::all();
     $categories= Category::all();
     return view('user.index',compact('users','categories'));
    }

public function store(Request $req)
{
    $this->validate($req, [
        'type' => 'required|string|max:1000',
        ]);
if($req->input('type') =='admin' ||$req->input('type') == 'editor'||$req->input('type') == 'technician') {
    $this->validate($req, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'contact' => 'required|string|max:15',
        'password' => 'required|string',
    ]);

    $user_name = $req->input('name');
    $user_email = $req->input('email');
    $user_contact = $req->input('contact');
    $user_type = $req->input('type');
    $user_password = $req->input('password');
    $current_time = Carbon::now()->toDateTimeString();
    $value = DB::select('select id from users where email=? ', [$user_email]);

  $data = array('name' => $user_name, 'email' => $user_email, 'contact' => $user_contact, 'type' => $user_type, 'password' => bcrypt($user_password), 'created_at'=>  $current_time, 'updated_at'=>  $current_time );
  if(count($value) == 0){
    DB::table('users')->insert($data);
      return redirect('/UserDetails')->with('success','User Data Was Added');
  }
  else{
      return redirect('/UserDetails')->with('success','The email you enter is already registered');
  }
 }


else{
    $this->validate($req, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'region' => 'required|string|max:20',
        'contact' => 'required|string|max:10',
        'city' => 'required|string|max:20',
        'zipcode' => 'required|string|max:300',
        'password' => 'required|string|min:6',
    ]);

    $user_name = $req->input('name');
    $user_email = $req->input('email');
    $user_city = $req->input('city');
    $user_contact = $req->input('contact');
    $user_type = $req->input('type');
    $user_region = $req->input('region');
    $user_zipcode = $req->input('zipcode');
    $user_password = $req->input('password');
    $current_time = Carbon::now()->toDateTimeString();
    $value = DB::select('select id from users where email=? ', [$user_email]);

    $data = array('name' => $user_name,'email' => $user_email, 'region' => $user_region, 'contact' => $user_contact, 'city' => $user_city, 'type' => $user_type, 'zipcode' => $user_zipcode, 'password' => bcrypt($user_password) ,'created_at'=>  $current_time, 'updated_at'=>  $current_time);
    if(count($value) == 0){
      DB::table('users')->insert($data);
      return redirect('/UserDetails')->with('success','User Data Was Added');
    }
    else{
      return redirect('/UserDetails')->with('success','The email you enter is already registered');
    }


}
}


    public function show($id)
    {

       $active = DB::table('devices')
            ->where('user_id', $id)
            ->value('state');


        if($active=='Active'){
            DB::table('devices')
            ->where('user_id', $id)
            ->update(['state' => 'Deactive']);
                   }
       else{
        DB::table('devices')
        ->where('user_id', $id)
        ->update(['state' => 'Active']);
       }
       return redirect('UserDetails');

    }

    public function edit($id)
    {
        $user = User::find($id);
        $categories = Category::all();
        return view('user.edit',compact('user','id'),compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $user= User::find($id);
        if($request->get('type')=='admin' || $request->get('type')=='editor'){
            $user->name=$request->get('name');
            $user->contact=$request->get('contact');
            $user->type=$request->get('type');
            $user->save();
        }
        else{
        $user->name=$request->get('name');
        $user->state=$request->get('state');
        $user->contact=$request->get('contact');
        $user->city=$request->get('city');
        $user->type=$request->get('type');
        $user->zipcode=$request->get('zipcode');
        $user->save();
        }
        return redirect('UserDetails');
    }

}
