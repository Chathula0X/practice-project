<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientControllerc extends Controller
{
    public function index(){
        $clients = Client::all();
        return view('AdminDashboard.Client.index', compact('clients'));
    }

    public function create(){
        return view('AdminDashboard.Client.create');
    }

    public function store(Request $request){
        $rules =[
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->country = $request->country;
        $client->save();

        return redirect()->route('client.index')->with('success', 'Client created successfully?');
    }

    public function edit($client_id){
        $client = Client::where('id', $client_id)->first();
        return view('AdminDashboard.Client.edit', compact('client'));
    }
     
    
    public function update(Request $request, $client_id){
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::find($client_id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->country = $request->country;
        $client->save();

        return redirect()->route('client.index')->with('success', 'Client updated successfully');
    }

    public function delete($client_id){
        $client = Client::find($client_id);
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted Successfully');
    }
}
