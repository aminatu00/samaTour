@extends('admin.layout')

@section('title', 'Créer un service')

@section('content')
<h1>Créer un service</h1>

<form action="{{ route('admin.services.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="name" required>
    
    <label>Description</label>
    <textarea name="description"></textarea>
    
    <button type="submit">Créer</button>
</form>
@endsection
