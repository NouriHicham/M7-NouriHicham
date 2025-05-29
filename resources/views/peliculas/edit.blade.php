@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edita pel·lícula</h1>
    <form action="{{ route('peliculas.update', $peliculas, false) }}" method="POST">
        @csrf
        @method('PUT')
        @include('peliculas.form')
        <button type="submit" class="btn btn-primary">Actualitza</button>
    </form>
</div>
@endsection
