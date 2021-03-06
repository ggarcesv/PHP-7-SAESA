@extends('layouts.master')
@include('partials.Navbar')

<title>@yield('title', 'Usuarios')</title>

@section('header')
    <h2>Configuración Usuarios</h2>
@stop

@section('content')
    {!! Form::model($usuario, ['route'=>['usuario.update', $usuario->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
        
    <div class="form-group">
            {!! Form::label('id', 'Id', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::number('id', null, ['class'=>'form-control']) !!}
                {!! $errors->has('id')?$errors->first('id'):'' !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('rut', 'Rut', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::number('rut', null, ['min'=>'0', 'max'=>'99999999','class'=>'form-control']) !!}
                {!! $errors->has('rut')?$errors->first('rut'):'' !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
                {!! $errors->has('nombre')?$errors->first('nombre'):'' !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
                {!! $errors->has('email')?$errors->first('email'):'' !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('password', 'Password', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
            {{ Form::input('password', 'password', $usuario->password) }}
                {!! $errors->has('password')?$errors->first('password'):'' !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('rol', 'Rol', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::select('rol_id', $rolList, null, ['placeholder' => 'Seleccione'], ['class'=>'form-control']) !!} 
                {!! $errors->has('rol_id')?$errors->first('rol_id'):'' !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('sede', 'Sede', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::select('sede_id', $sedeList, null, ['placeholder' => 'Seleccione'], ['class'=>'form-control']) !!} 
                {!! $errors->has('sede_id')?$errors->first('sede_id'):'' !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('estado', 'Estado', ['class'=>'control-label col-md-2']) !!}
            <div class="col-md-3">
                {!! Form::select('estado', array('1' => 'Habilitado', '0' => 'Deshabilitado'),['class'=>'form-control']) !!}
                {!! $errors->has('estado')?$errors->first('estado'):'' !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@stop