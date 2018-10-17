<?php

namespace App\Http\Controllers;
use App\Client;
use App\Addresse;
use Illuminate\Http\Request;
use App\Http\usualMethods\Upload;
class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::all();
        return view('clients.index')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = Addresse::create($request->all());
        $file = $request->file('imageToUpload');
        $client =new Client();
        $client->nom =$request->input('nom');
        $client->email =$request->input('email');
        $client->Tel =$request->input('Tel');
        $client->adresseId= $page->id;
        if ($file!=null)
        {
            $path = Upload::uploadFile($file,'pictures');
            $client->picture_Path =$path;
        }
        $client->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       // $adresse =Client::where('id',$id)->get();
        //$adresseId =$adresse[0]->adresseId;
        //Client::destroy($id);
        //Addresse::destroy($adresseId);
        return redirect('/clients');

    }
}
