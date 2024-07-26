@extends('admin.layouts.app')
@section('title','Listagem de Usuários')
@section('content')
<h1>Usuários</h1>
{{-- 
@if(session()->has('success'))
    {{session('success')}}
@endif

@if(session()->has('message'))
    {{session('message')}}
@endif --}}
<a href="{{route('users.create')}}">Adicionar</a>
<x-alert/>

<table>
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Email:</th>
            <th>Ações:</th>
            <th>Ver perfil:</th>
        </tr>
    </thead>
    <tbody>
        
        @forelse($users as $user)
        <tr>
        <td>{{ $user->name }}</td>

        <td>{{ $user->email }}</td>
        <td><a href="{{route('users.edit', $user->id)}}">Edit</a></td>
        <td><a href="{{route('users.show', $user->id)}}">Detalhes</a></td>


        @empty
        <p>Nenhum item encontrado</p>
        
        @endforelse

        </tr>   
      
      
    </tbody>
</table>
{{$users->links()}}

@endsection