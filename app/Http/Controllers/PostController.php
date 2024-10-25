<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('posts.index');
    }
    public function create(){
        return  view('posts.create');
    }
    public function store(){
        return 'Aqui se procesara el formulario para crear un post';
    }
    public function show($post){
        return  view('posts.show', compact('post'));
    }
    public function edit($post){
        return view('posts.edit');
    }
    public function update($post){
        return 'Aqui se actualiza una lista con todos los post';
    }
    public function destroy($post){
        return 'Aqui se elimina una lista con todos los post';
    }
}
