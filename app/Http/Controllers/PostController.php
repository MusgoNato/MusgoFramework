<?php 


namespace App\Http\Controllers;

class PostController
{
    public function index()
    {
        return view('post', ['title' => 'Index do post']);
    }
    public function show(string $id)
    {
        
    }
    public function edit(string $id)
    {
        
    }
    public function update(string $id)
    {
        
    }
    public function store(string $request)
    {
        
    }
    public function destroy(string $id)
    {
        
    }

}