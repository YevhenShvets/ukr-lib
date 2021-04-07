@extends('layouts.app')

@section('title')Добавлення типу тексту@endsection

@section('content')
<div class="container main-div">
    <div style="display:block; margin: 0 auto; background:rgba(255,255,255,0.9); padding:20px; border-radius:10px; margin-bottom:20px;">
    <table class="table table-striped" style="background:rgba(255,255,255,1);">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Назва</th>
            <th scope="col">Опис</th>
            <th scope="col">Дія</th>
            </tr>
        </thead>
        <tbody>
            @forelse($types as $t)
            <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{$t->name}}</td>
            <td>{{$t->description}}</td>
            <td>
            <form action="{{ route('adminDeleteTextTypeSubmit') }}" method="post">
                @csrf
                <input type="text" name="id" value="{{ $t->id }}" hidden>
                <button type="submit" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" style="color:black;" height="22" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
            </form>
            </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">Типів творів ще не добавлено</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.9); margin-bottom:200px;">
                <div class="card-header text-center bg-secondary" style="font-size: 22px">{{ __('Форма для добавлення типу твору') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminAddTextTypeSubmit') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Назва') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Введіть назву" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Опис') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Введіть опис" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Добавити') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
