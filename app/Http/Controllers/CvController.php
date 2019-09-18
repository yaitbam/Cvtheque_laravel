<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Cv;
use Auth;

use App\Http\Requests\cvRequest;

class CvController extends Controller
{

    //Check if the user id logged 
    public function  __construct(){
         $this->middleware('auth');
    }
   
    //lister les cvs
    public function index(){
        // $listcv = Cv::all();
        // $listcv = Cv::where('user_id', Auth::user()->id)->get(); //afficher juste ls cv d'un user connecte

        if(Auth::user()->is_admin){
            $listcv = Cv::all();
        }
        else{
            $listcv = Auth::user()->cvs;
        }


        return view('cv.index', ['listcv' => $listcv]);
    }

    //affiche la formulaire de cv 
    public function create(){
        return view('cv.create');
    }

    //Permet d'enregister de cv
    public function store(cvRequest $request){
        // return $request->all();
        $cv = new Cv();

        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->user_id = Auth::user()->id;

        if($request->hasFile('photo')){
            $cv->photo =  $request->photo->store('image');
        }

        $cv->save();

        session()->flash('success', 'Le cv e ete bien enregistre!!');

        return redirect('cvs');
    }


    //Permet de recuperer un cv puis de le mettre dans un formulaire
    public function edit($id){
        $cv = Cv::find($id);

        
        $this->authorize('update', $cv); //exucute function update in policy 

        return view('cv.edit', ['cv' => $cv]);
    }

    //Permet de modifier
    public function update(cvRequest $request, $id){
        $cv = Cv::find($id);

        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        if($request->hasFile('photo')){
            $cv->photo =  $request->photo->store('image');
        }

        $cv->save();

        return redirect('cvs');
    }

    //Permet de supprimer
    public function destroy(Request $request, $id){
        
        $cv = Cv::find($id);

        $this->authorize('delete', $cv); //exucute function update in policy 

        $cv->delete();

        return redirect('cvs');
    }
}
