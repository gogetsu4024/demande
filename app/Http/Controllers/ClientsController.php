<?php

namespace App\Http\Controllers;
use App\Client;
use App\Addresse;
use Illuminate\Http\Request;
use App\Http\usualMethods\Upload;
use Illuminate\Support\Facades\Storage;
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
        $client= Client::where('id',$id)->get();
        //dd($client[0]);
        return view('clients.edit')->with('client',$client[0]);
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

        $adresse = Addresse::find($request->input('adresseId'));
        $adresse->update($request->all());
        $client = Client::find($id);
        $client->update($request->all());
        $file = $request->file('imageToUpload');
        if ($file!=null)
        $path = Upload::uploadFile($file,'pictures');
        else
            $path='/assets/images/nopicture.jpg';
        if ($path!='/assets/images/nopicture.jpg')
        {
            if (file_exists(public_path().$client->picture_Path))
            unlink(public_path().$client->picture_Path);
        }
        $client->picture_Path =$path;
        $client->save();
        return redirect('/clients') ;
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
        $client = Client::find($id);
        $path = $client->picture_Path;
        if ($path!='/assets/images/nopicture.jpg')
        {
            if (file_exists(public_path().$client->picture_Path))
                unlink(public_path().$client->picture_Path);
        }
        //Client::destroy($id);
        //Addresse::destroy($adresseId);
        return redirect('/clients');

    }
}
