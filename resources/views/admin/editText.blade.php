@extends('layouts.app')

@section('title')Редагування тексту@endsection

@section('content')
@isset($text)
<div class="container main-div">
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.9);">
                <div class="card-header text-center bg-info" style="font-size: 22px">{{ __('Редагування твору') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminAddTextSubmit') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Назва') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" placeholder="Введіть назву" name="name" value="{{ $text->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                            <div class="col-md-6">
                                <select id="author" class="form-control form-select" name="author" required>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ ($author->id == $text->id_author) ? 'selected' : '' }}>{{ $author->PIB }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Тип твору') }}</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control form-select" name="type" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}"  {{ ($type->id == $text->id_type) ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Оновити') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color:rgba(255,240,250,0.85); margin-top:20px; margin-bottom:300px; padding:40px; padding-top:5px; border-radius:10px;">
        @isset($pages)
        <table class="table table-striped" style="background:rgba(255,255,255,1);">
            <thead>
                <tr>
                <th scope="col">Назва файлу</th>
                
                <th scope="col">Дія</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $p)
                <tr>
                <th scope="row">{{ $p }}</th>
                <td>
                    <div style="display:flex;">
                        <a href="{{ URL::asset($p) }}" style="padding-top:5px; color:blue; margin-right:10px;" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>
                        <form action="{{ route('adminEditTextDeletePage', $text->id) }}" method="POST">
                            @csrf
                            <input type="text" value="{{ $p }}" name="file_name" hidden>
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" style="color:red;" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;"><h3>Сторінок немає</h3></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @else
        <h3 style="text-align:center;">Сторінок немає</h3>
        @endisset
        <div class="row justify-content-center">
            <div class="col-md-8" style="">
                <div class="card" style="background-color: rgba(255,255,255,0.9);">
                    <div class="card-header text-center bg-warning" style="font-size: 22px">{{ __('Добавлення сторінок') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adminEditTextAddPage', $text->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Номер сторінки') }}</label>
                                <div class="col-md-6">
                                    <input id="number" type="number" class="form-control" placeholder="Введіть номер" name="number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label for="page" class="col-md-4 col-form-label text-md-right">{{ __('Файл') }}</label>

                            <div class="col-md-6">
                                <input id="page" type="file" class="form-control" name="page" required>
                            </div>
                        </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
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
@else
<div class="main-div">
<h2 style="text-align:center; color:white; text-shadow: 2px 2px 2px rgba(0,0,0,0.84);">Даного твору не існує</h2>
</div>
@endisset
@endsection
