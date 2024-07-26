@extends('admin.layouts.app')
@section('title','Criar novo Usuario')

@section('content')

    <h1>Novo Usuário</h1>

  
    <form action="{{route('users.store')}}" method="POST">
        <!-- <input type="text" name="_token" value="{{ csrf_token()}}"> -->
        <!-- tem um jeito melhor com uma class diretiva -->
       @include('admin.users.partials.form')
</form>

@endsection
