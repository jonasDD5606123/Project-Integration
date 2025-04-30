<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
    <!-- Bootstrap CSS via CDN -->
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Groepen Beheer</h1>

    <!-- Groep toevoegen -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Nieuwe Groep Toevoegen</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="group_naam" class="form-control" placeholder="Groep naam" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Toevoegen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lijst van groepen -->
    <div class="row">
        @foreach($groups as $group)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $group->naam }}</h5>
                    <div>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editGroup{{ $group->id }}">
                            Bewerken
                        </button>
                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je deze groep wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Studenten lijst -->
                    <h6>Studenten:</h6>
                    <ul class="list-group">
                        @foreach($group->students as $student)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $student->naam }}
                            <form action="{{ route('groups.remove-student', ['group' => $group->id, 'student' => $student->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Verwijderen</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Student toevoegen -->
                    <form action="{{ route('groups.add-student', $group->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <select name="student_id" class="form-select">
                                <option value="">Student selecteren...</option>
                                @foreach($available_students as $student)
                                <option value="{{ $student->id }}">{{ $student->naam }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Toevoegen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal voor groep bewerken -->
        <div class="modal fade" id="editGroup{{ $group->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Groep Bewerken</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('groups.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Groep naam</label>
                                <input type="text" name="group_naam" class="form-control" value="{{ $group->naam }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection