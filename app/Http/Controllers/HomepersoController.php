<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Postulante;
use Session;
use GuzzleHttp\Exception\GuzzleException;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->input('cedula')) {
            $existe = Postulante::where('ci',$request->input('cedula'))->get();
            if($existe->count() >= 1){
                Session::flash('error', 'Ya existe el postulante!');
                return redirect()->back();
            }

        /*$expediente = SIG005::where('NroExp',$request->input('NroExp'))
        ->where('NroExpS','A')
        ->first();

        $historial = SIG006::where('NroExp',$request->input('NroExp')/*$idexp 1803411)
        ->where('NroExpS','A'/*$request->input('NroExpS'))
        ->orderBy('DENroLin', 'asc')
        ->get();
        $nroexp = $request->input('NroExp');
            return view('home',compact('expediente','historial','nroexp'));*/
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
                    return view('createform',compact('nroexp','cedula','nombre','apellido','fecha_nac','sexo',
                    'nacionalidad','est'));
                }

                //$nombre = $datos->nombres;
                //echo $cedula->getBody()->getContents();
            }else{
                Flash::success($book->message);
                return redirect()->back();
            }
        }else{

            $nroexp = '';
            return view('createform',compact('nroexp'));
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
        $existe = Postulante::where('ci',$request->ci)->get();
        if($existe->count() >= 1){
            Session::flash('error', 'Ya existe el postulante!');
            return redirect()->back();
        }

        $postulante = new Postulante();
        $postulante->ci=$request->ci;
        $postulante->nombre=$request->nombre;

        $postulante->apellido=$request->apellido;
        $postulante->sexo=$request->sexo;

        $postulante->fecha_nac=$request->fecha_nac;
        $postulante->nacionalidad=$request->nacionalidad;
      
        $postulante->telefono=$request->telefono;
        $postulante->vivienda=$request->vivienda;

        $postulante->profesion=$request->profesion;
        $postulante->lugar_trabajo=$request->lugar_trabajo;
       
        $postulante->nflia=$request->nflia;
        $postulante->napte=$request->napte;

        $postulante->ingresof=$request->ingresof;
        $postulante->lugar_vivienda=$request->lugar_vivienda;

        $postulante->monto_apagar=$request->monto_apagar;
    
        //$postulante->ingreso=$request->ingreso;
       // $postulante->estado_civil=$request->estado_civil;
        //$postulante->celular=$request->celular;


        $postulante->save();

        Session::flash('message', 'Se ha inscripto Correctamente!');
        return redirect()->route('inicio');
        //var_dump($request->all());
        //return "hola";


        //
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
