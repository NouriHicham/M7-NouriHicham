@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Llistat de pel·lícules</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Títol</th>
                <th>Any</th>
                <th>Duració</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peliculas as $pelicula)
                <tr>
                    <td>{{ $pelicula->title }}</td>
                    <td>{{ $pelicula->year }}</td>
                    <td>{{ $pelicula->duration }}</td>
                    <td>
                        <a href="{{ route('peliculas.edit', $pelicula, false) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('peliculas.destroy', $pelicula, false) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
