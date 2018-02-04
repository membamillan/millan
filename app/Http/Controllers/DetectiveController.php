<?php

namespace App\Http\Controllers;

use  Auth;
use App\Court_case;
use App\Notifications\AssignedDetective;
use App\Case_contact;
use App\Admin;
use App\User;
use App\Type;
use App\Statement;
use App\Contact;
use App\Report_crime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Input;
use Session;
use Charts;

class DetectiveController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:admin');
  }
//load the detective dashboard
    public function index()
    {
       $id = Auth::id();
       $request = DB::table('statements')->where('status',0)
       ->where('admin_id', $id)
       ->get();

      return view('admin.detective_dashboard',array('request' => $request ));
    }
//fetch the selected statement
    public function get_index($id)
    {
         $me = Auth::id();
         $request =Report_crime::all();
         $detective = DB::table('contacts')->where('admin_id',$me)
         ->get();
         $statement = DB::table('statements')->where('id',$id)
         ->get();

       return view('admin.detective_view_requests',['request' => $request, 'detective' => $detective ,'statement' => $statement ]);

    }

  //creates case function
    public function create()
    {

           $id = Auth::id();
           $crime_id=Input::get('crime_id');
           $statement_id=Input::get('statement_id');

           //creates an instance of a case and returns it for use in updating pivot table
          $recent_entry =Court_case::create(array(
          'admin_id'=>$id ,
          'statement_id'=>$statement_id,
          'report_crimes_id'=>$crime_id,
          'statement'=>Input::get('statement')

      ));

              // on create case updates the statement to read
                $statement = Statement::find($statement_id);
                if($statement){
                  $statement->status =1;
                  $statement->save();

                // on create updates the report crime to received
                  $crime = Report_crime::find($crime_id);
                   if($crime){
                     $crime->status =2;
                     $crime->save();

    //double checks if the case instance exists
               $case_id= $recent_entry->id;
               $present= Court_case::findOrFail($case_id);

              //updates the case_contacts tables

                       if($present){

                            $present->contacts()->attach(['contact_id'=>Input::get('contact_id')]);

                           }

                    $me = DB::table('report_crimes')->where('id',$crime_id)
                    ->value('user_id');
                    $contact = DB::table('case_contacts')->where('court_case_id',$case_id)
                    ->value('contact_id');
                    $detective = DB::table('contacts')->where('id',$contact)
                    ->select('Fname','lname','phone','email')
                    ->get();
                    //get user associated with the case
                     $user = User::find($me);
                     $user->notify(new AssignedDetective($detective) );
                      //if succesfull the redirects to homepage
                     return redirect()->route('admin.dashboard')->with('message','Statement recorded  succesfully');

               }

                  }
                   // if operation unsuccessfull then redirect back
                    return redirect()->back()->with('message','Statement not recorded please try again');

    }

// adds new station
    public function create_station()
    {
            $id = Auth::id();
           $crime_id=Input::get('crime_id');
      Admin::create(array(
          'crime_id'=>$crime_id,
          'admin_id'=>Input::get('admin_id'),
          'ob_number'=>Input::get('ob_number'),
          'date'=>Input::get('date'),
          'status'=> 0,
          'police_number'=>Input::get('police_number'),
          'statement'=>Input::get('statement')

      ));
       return redirect()->route('admin.dashboard')->with('message','Station created  succesfully');

    }
    public function get_detective()
    {
       $id = Auth::id();
       $request = DB::table('statements')->where('status',0)
       ->where('admin_id', $id)
       ->get();
       $type = Type::all();

      return view('admin.add-detective',array('request' => $request ),array('type' => $type ));
    }

// adds new detective
    public function create_detective()
    {
            $id = Auth::id();

      Contact::create(array(
        'Fname'=> Input::get('Fname'),
        'lname'=> Input::get('lname'),
        'email'=> Input::get('email'),
        'type_id'=>Input::get('type_id'),
        'admin_id'=>$id,
        'phone'=>Input::get('phone'),
        'rank'=>Input::get('rank'),


      ));
       return redirect()->route('admin.dashboard')->with('message','Detective added  succesfully');

    }

//add new type
    public function create_type()
    {
            $id = Auth::id();
           $crime_id=Input::get('crime_id');
      Admin::create(array(
          'crime_id'=>$crime_id,
          'admin_id'=>Input::get('admin_id'),
          'ob_number'=>Input::get('ob_number'),
          'date'=>Input::get('date'),
          'status'=> 0,
          'police_number'=>Input::get('police_number'),
          'statement'=>Input::get('statement')

      ));
       return redirect()->route('admin.dashboard')->with('message','crime type added succesfully');

    }
}
