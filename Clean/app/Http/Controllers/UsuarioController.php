<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['usuarios']=usuario::paginate(10);
        return view('usuario.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'Nombre'=>'required | string|max:100',
            'ApellidoPaterno'=>'required | string|max:100',
            'ApellidoMaterno'=>'required | string|max:100',
            'Correo'=>'required |email',
            'Foto'=>'required |max:10000|mimes:jpeg,png,jpg',
        ];
   
        $mensaje=[
                'required'=> 'El :attribute es requerido',
                'Foto.required'=>'Foto requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosUsuario=$request->except('_token');
        if ($request->hasFile('Foto')){
            $datosUsuario['Foto']=$request->file('Foto')->store('uploads','public');
        }
        usuario::insert($datosUsuario);
        return redirect('usuario')->with('mensaje','Empleado agregardo con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=usuario::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required | string|max:100',
            'ApellidoPaterno'=>'required | string|max:100',
            'ApellidoMaterno'=>'required | string|max:100',
            'Correo'=>'required | email',
        ];
   
        $mensaje=[
                'required'=> 'El :attribute es requerido',
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required |max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'Foto requerida'];

        }
        $this->validate($request,$campos,$mensaje);
        $datosUsuario=$request->except(['_token','_method']);
        if ($request->hasFile('Foto')){
            $usuario=usuario::findOrFail($id);
            Storage::delete('public/'.$usuario->Foto);
            $datosUsuario['Foto']=$request->file('Foto')->store('uploads','public');
        }
        usuario::where('id','=',$id)->update($datosUsuario);
        $usuario=usuario::findOrFail($id);
        //return view('usuario.edit',compact('usuario'));
        return redirect('usuario')->with('mensaje','Datos de Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $usuario=usuario::findOrFail($id);
        if(Storage::delete('public/'.$usuario->Foto)){
            usuario::destroy($id);
        }
      
        return redirect('usuario')->with('mensaje','Usuario Borrado');

    }
}
