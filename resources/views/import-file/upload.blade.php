@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            Upload
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#modalError">
                            Erros
                        </button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Diretório</th>
                            <th scope="col">Disco</th>
                            <th scope="col">Status</th>
                            <th scope="col">Linhas importadas</th>
                            <th scope="col">Linhas com erros</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $model)
                            <tr>
                                <td>{{$model->id}}</td>
                                <td>{{$model->file_name}}</td>
                                <td>{{$model->path}}</td>
                                <td>{{$model->disk}}</td>
                                <td>{{$model->status}}</td>
                                <td>{{$model->imported_lines}}</td>
                                <td>{{$model->lines_errors}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('import-file.modal-upload')
                    @include('import-file.modal-error')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
