<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\C;
use App\userinfo;
use Excel;


class MainController extends Controller
{
    
    protected $redirectTo = '/';
    
    public function showRegisterForm() {
        return view('user');        
    }
    
    protected function validateUser(Request $request) {        
        $validator = Validator::make(
                     $request->all(),userinfo::validationRules(),userinfo::validationRulesMessages());
        if ($validator->fails()){
            return redirect('/')->withErrors($validator);
        }
    }
    
    public function create(Request $request) {
        $this -> validateUser($request);
        $user =  userinfo :: where("email", "=", $request -> email) -> first();
        if($user) {
            $user -> ModifiedDate = date("Y-m-d H:i:s");           
        } else {
            $user = new userinfo();
            $user -> CreatedDate = date("Y-m-d H:i:s");
            $user -> ModifiedDate = date("Y-m-d H:i:s");
        }
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> phone = $request -> phone;
        $user -> city = $request -> city;
        $user -> save();
        $user =  userinfo :: get();
        Excel::create('users', function($excel) use ($user) {

            // Set the title
            $excel->setTitle('User Info');

            // Chain the setters
            $excel -> setCreator('Animesh')
                   -> setCompany('Animesh');

            // Call them separately
            $excel->setDescription('User Info');
            $excel->sheet('User Data', function($sheet) use($user) {
                $data[] = ['Id', 'Name', 'Email', 'Phone', 'City'];
                foreach($user as $userData) {
                    $data[] = array($userData -> id, $userData -> name, $userData -> email, $userData -> phone, $userData -> city);
                }
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->store('xlsx');
        //Session::flash('download.in.the.next.request', 'testing.xlsx');
        return redirect($this -> redirectTo)->with("vmessage","User Created / Updated Successfully");
         
    }
    
    public function download($file_name) {
        $file_path = storage_path('exports/'.$file_name);
        return response()->download($file_path);
    } 
    
}
