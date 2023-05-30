<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AnnouncementController extends Controller
{
    public function create()
    {
        return view('announcements.create');
    }
//create
    public function store(Request $request)
    {
       
        $formFields = $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'content' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();


        announcement::create($formFields);
        // Redirect to the list of announcements
        Alert::success('success', 'created successfuly!');
        return redirect('announcements')->with('success','created successfuly!');
    }
        //edit
        public function edit(announcement $announcement)

        {
            return view('announcements.edit', [
                'announcement' => $announcement
            ]);
        } 
            
        //update
        public function update(Request $request, announcement $announcement)
        {
           
            
            $formFields = $request->validate([

            
                    'title' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'content' => 'required'
            ]);

            if($request->hasFile('logo')) {
                $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $announcement->update($formFields);
            Alert::success('success', 'Updated successfuly!');
            return redirect('announcements')->with('success', 'Updated successfuly!');
            
            }
          

            //main page
                public function index()
                {    
                  
                    return view('announcements.index',['announcements' => auth()->user()->announcement()->latest()->filter(request(['search']))->get()
                    ]);
                }

                public function trashed()
                {   
                    $announce = announcement::onlyTrashed()->orderBy('id','DESC')->get();
                    // dd($announce);
                  return view('announcements.trashed',['announcements' => $announce
                    ]);
                }
                    //restore
                public function restore($id)
                {      
                    Alert::success('success', 'restore successfuly!');
                    $announce = announcement::withTrashed()->findOrFail($id);
                   
                    if(!empty($announce)){
                        $announce->restore();
                    }
                    return redirect('announcements')->with('success', 'restore successfuly!');
                }

                     //delete 
                     public function deletePermanent($id)
                     {      
                        Alert::success('success', 'deleted successfuly!');
                         $announce = announcement::withTrashed()->findOrFail($id);
                        
                         if(!empty($announce)){
                             $announce->forceDelete();
                         }
                         return redirect('announcements')->with('success', 'delete successfuly!');
                       
                     }

            //show 
            public function show(announcement $announcement)
            {
                
                $ann = announcement::all();
    
             

                $userData = $ann->where('content')->first();
                
                
                return view('announcements.announcements', [
                    'announcements' => $userData
                ]);
            }

              //delete
              public function delete(announcement $announcement)
              {
                Alert::success('success', 'deleted successfuly!');
                 $announcement->delete();
                 return redirect('/announcements')->with('success', 'Deleted successfuly!');
              }


}
