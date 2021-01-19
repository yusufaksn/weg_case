<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PersonelInformation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $userQuery =  DB::table('users')->where(['users.deleted_at' => null])->orderBy('users.id','desc')
            ->join('user_role', function($join){

                $join->on('users.user_role_id', '=', 'user_role.id');

            })
          ->join('personel_information', function($join2)
            {
                $join2->on('users.id', '=', 'personel_information.user_id');
            })
            ->paginate(10,['user_role.role_name','users.name','users.email','users.id as userid']);
        return  $userQuery;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users'
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }
        $data = $request->only('name','email','password','role_name');

                  $userId = DB::table('users')->insertGetId([
                       'name' => $request->input('name'),
                       'email' => $request->input('email'),
                       'password' =>  bcrypt($request->input('password')),
                       'user_role_id' => $request->input('user_role_id'),
                       'created_at' => date('Y-m-d H:i:s'),
                       ]);
                    DB::table('personel_information')->insert([
                        'user_id' => $userId,
                        'gender_id' => $request->input('gender'),
                        'phone' => $request->input('phone'),
                        'note' => $request->input('note'),
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);

        return response()->json([
            'success' => true,
            'message' => 'Kayıt Başarı İle gerçekleştirildi'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $user = new UserResource(User::find($id));
        $userQuery =  DB::table('users')->where('users.id' , $id)->orderBy('users.id','desc')
            ->join('user_role', function($join)
            {
                $join->on('users.user_role_id', '=', 'user_role.id');
            })
            ->join('personel_information', function($join2)
            {
                $join2->on('users.id', '=', 'personel_information.user_id');
            })
            ->get(['user_role.role_name as user_role_id',
                'personel_information.gender_id as gender',
                'personel_information.phone as phone',
                'personel_information.note as note',
                'users.name as name',
                'users.email as email',
                'users.user_role_id as user_role_id',
                'users.id as id']);

        return response()->json($userQuery,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        DB::table('users')->where(['id' => $request->input('id')])->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>  bcrypt($request->input('password')),
            'user_role_id' => $request->input('user_role_id'),
            'updated_at' => date('Y-m-d')
        ]);
        DB::table('personel_information')->where(['user_id'=> $request->input('id') ])->update([
            'gender_id' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'note' => $request->input('note'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Kayıt Başarı İle gerçekleştirildi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where(['id' => $id])->update(['deleted_at' => date('Y-m-d') ]);
        DB::table('personel_information')->where(['user_id' => $id])->update(['deleted_at' => date('Y-m-d') ]);
    }
}
