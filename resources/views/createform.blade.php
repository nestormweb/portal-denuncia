@extends('adminlte::page')

@section('title', 'Formulario de Denuncia MUVH')

@section('content_header')
<h1>Formulario de Denuncia  </h1>
@stop

@section('content')



<form action="/formulario" method="post" id="my-form" enctype="multipart/form-data" xl-form>
    @csrf
    {!! csrf_field() !!}
    @method('POST')
<div class="box box-primary">
<div class="box-header with-border">
              <h3 class="box-title">Datos  Personales del denunciante</h3>
            </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label>N°CEDULA :</label>
                    <input type="text" name="cedula" class="form-control" value="{{isset($cedula)? $cedula :null}}" readonly>
                </div>
                <div class="form-group ">
                    <label> TELEFONO:</label>
                    <input type="text" class="form-control" name="telefono" value=''>
                </div>
                 <div class="form-group ">
                    <label> E-MAIL:</label>
                    <input type="text" class="form-control" name="email" value=''>
                  
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group ">
                    <label> NOMBRE: </label>
                    <input type="text" name="nombre" class="form-control" value="{{ isset($nombre)? $nombre :null}}" readonly>
                </div>
                <div class="form-group ">
                    <label>CALLE:</label>
                    <input type="text" class="form-control" name="calle" maxlength="40">
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group ">
                    <label>APELLIDO</label>
                    <input type="text" name="apellido" class="form-control" value="{{ isset($apellido)? $apellido :null}}" readonly>

                </div>
                <div class="form-group ">
                    <label> N° CASA </label>
                    <input type="text" class="form-control" name="numerocasa" value=''>
                </div>


            </div>



        </div>





    </div>
</div>
<div class="box box-primary">
<div class="box-header with-border">
              <h3 class="box-title">Antecedentes adicionales</h3>
            </div>    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label>DENUNCIA</label>
                    <textarea class="form-control"name="denu" rows="3" placeholder="Escriba su denuncia"></textarea>
                </div>
                <div class="form-group ">
                    <label> OTRA SITUACIÓN</label>
                    <textarea class="form-control"name="otrasituacion" rows="3" placeholder="Emplee otra situacion"></textarea>
                </div>
                <div class="form-group ">
                    <label>DEPARTAMENTO</label>
                    <select name="departamento" id="nombre" class="form-control">
                        <option value="">Seleccione su Dpto</option>
                        @foreach($dpto as $depa)
                          <option value="{{ $depa->id }}">{{ $depa->nombre }}</option>
                        @endforeach
                      </select>                </div>
                <div class="form-group ">
                    <label> MUNICIPIO</label>
                    <input type="text" class="form-control" name="municipio" value=''>
                </div>
                <div class="form-group ">
                    <label> COMUNIDAD</label>
                    <input type="text" class="form-control" name="comunidad" maxlength="40">
                </div>
                <div class="form-group ">
                    <label> TIPO INFRACCIÓN</label>
                    <select name="infraccion" id="infracciones" class="form-control">
                        <option value="">Seleccione el tipo de infraccion</option>
                        @foreach($infrac as $infra)
                          <option value="{{ $infra->id }}">{{ $infra->infracciones }}</option>
                        @endforeach
                      </select>
</div>
                
                </div>

            <div class="col-md-6">
              PARA EL MAPA
            </div>



            </div>

            <button type="submit" class="btn btn-primary pull-right">Enviar</button>


        </div>





    </div>
    


        </div>
</form>
<div class="box box-primary">
<div class="box-header with-border">
              <h3 class="box-title">Antecedentes adicionales</h3>
            </div>
</div>



@stop

