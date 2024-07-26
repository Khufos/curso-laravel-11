@extends('admin.layouts.app')
@section('title','Editar o Usuário')

@section('content')

    <h1>Editar Usuario {{$user->name}}</h1>

    {{-- <x-alert/> --}}
    <form action="{{route('users.update', $user->id)}}" method="POST">
        <!-- <input type="text" name="_token" value="{{ csrf_token()}}"> -->
        <!-- tem um jeito melhor com uma class diretiva -->
        {{-- @csrf() --}}
        @method('put')
        {{-- <input type="text" name="_method" value="PUT"> --}}
        @include('admin.users.partials.form')
</form>

@endsection
