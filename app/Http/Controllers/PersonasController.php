<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Personas;
use App\Denuncia;
use App\Infraccion;
use App\Departamentos;


class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('welcome');

       // return view ('home');
       //$infrac=Infraccion::all();
      // var_dump ($infrac);
       //return view('home',compact('infrac'));

      // $dpto=Departamentos::all();
       //return view('welcome',compact('dpto','infrac'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  

        

        if ($request->input('cedula')) {
            $existe = Personas::where('cedula',$request->input('cedula'))->get();
            if($existe->count() >= 1){
                \Session::flash('error', 'Ya existe el denunciante!');
                return redirect()->back();
            }

            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $GetOrder = [
                'username' => 'senavitatconsultas',
                'password' => 'S3n4vitat'
            ];
            $client = new client();
            $res = $client->post('http://10.1.79.7:8080/mbohape-core/sii/security', [
                'headers' => $headers,
                'json' => $GetOrder,
                'decode_content' => false
            ]);
            //var_dump((string) $res->getBody());
            $contents = $res->getBody()->getContents();
            $book = json_decode($contents);
            //echo $book->token;
            if($book->success == true){
                //obtener la cedula
                $headerscedula = [
                    'Authorization' => 'Bearer '.$book->token,
                    'Accept' => 'application/json',
                    'decode_content' => false
                ];
                $cedula = $client->get('http://10.1.79.7:8080/frontend-identificaciones/api/persona/obtenerPersonaPorCedula/'.$request->input('cedula'), [
                    'headers' => $headerscedula,
                ]);
                $datos=$cedula->getBody()->getContents();
                $datospersona = json_decode($datos);
                if(isset($datospersona->obtenerPersonaPorNroCedulaResponse->return->error)){
                    //Flash::error($datospersona->obtenerPersonaPorNroCedulaResponse->return->error);
                    Session::flash('error', $datospersona->obtenerPersonaPorNroCedulaResponse->return->error);
                    return redirect()->back();
                }else{
                    $nombre = $datospersona->obtenerPersonaPorNroCedulaResponse->return->nombres;
                    $apellido = $datospersona->obtenerPersonaPorNroCedulaResponse->return->apellido;
                    $cedula = $datospersona->obtenerPersonaPorNroCedulaResponse->return->cedula;
                    $sexo = $datospersona->obtenerPersonaPorNroCedulaResponse->return->sexo;
                    $fecha_nac = date('Y-m-d', strtotime($datospersona->obtenerPersonaPorNroCedulaResponse->return->fechNacim));
                    $nacionalidad = $datospersona->obtenerPersonaPorNroCedulaResponse->return->nacionalidadBean;
                    $est = $datospersona->obtenerPersonaPorNroCedulaResponse->return->estadoCivil;
                    $nroexp = $cedula;
                    //var_dump($datospersona->obtenerPersonaPorNroCedulaResponse);
                    $dpto=Departamentos::all();
                    $infrac=Infraccion::all();
                    return view('createform',compact('nroexp','cedula','nombre','apellido','fecha_nac','sexo',
                    'nacionalidad','est','dpto','infrac'));
                }

                //$nombre = $datos->nombres;
                //echo $cedula->getBody()->getContents();
            }else{
                Flash::success($book->message);
                return redirect()->back();
            }
        }else{

            $nroexp = '';
            return view('welcome',compact('nroexp'));
        }
        
    }
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

//return $input;
        var_dump($input);
        $existe = Personas::where('cedula',$request->ci)->get();
        if($existe->count() >= 1){
            Session::flash('error', 'Ya existe el postulante!');
            return redirect()->back();

        }
    //return $request;
        $personas = new Personas();

        $personas->cedula = $request->cedula;
        $personas->nombre = $request->nombre;
        $personas->apellido = $request->apellido;
        $personas->telefono = $request->telefono;
        $personas->numerocasa = $request->numerocasa;
        $personas->calle= $request->calle;

        $personas->save();

     


       // return ('se ha guardado exitosamente');
    //return $request;

        $denun = new Denuncia();

        $denun->denu = $request->denu;
        $denun->municipio= $request->municipio;
        $denun->otrasituacion = $request->otrasituacion;
        $denun->comunidad = $request->comunidad;
        $denun->departamento= $request->departamento;
        $denun->infraccion = $request->infraccion;
        $denun->persona_id=$personas->id;
        $denun->save();

        return redirect('/')->with('success', 'Se ha registrado correctamente su denuncia!');
      
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
        //
    }
}
