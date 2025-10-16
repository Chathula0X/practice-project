<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
Use App\Http\Requests\UpdateClientRequest;

class ClientControllerc extends Controller
{
    public function index(){
        $clients = Client::all();
        return view('admin-dashboard.client.index', compact('clients'));
    }

    public function create(){
        return view('admin-dashboard.client.create');
    }

    public function store(StoreClientRequest $request){
       
        $client = Client::create($request->validated());
        return redirect()->route('client.index')->with('success', 'Client created successfully?');
    }

    public function edit($client_id){
        $client = Client::where('id', $client_id)->first();
        return view('admin-dashboard.client.edit', compact('client'));
    }
     
    
    public function update(UpdateClientRequest $request, $client_id){
      
        $client = Client::findOrFail($client_id);
        $client->update($request->validated());

        return redirect()->route('client.index')->with('success', 'Client updated successfully');
    }

    public function delete($client_id){
        $client = Client::find($client_id);
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted Successfully');
    }
}
