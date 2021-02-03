@extends('layouts.app')

@section('title')Добавлення тексту@endsection

@section('content')
<div class="container main-div">
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.9);">
                <div class="card-header text-center bg-secondary" style="font-size: 22px">{{ __('Форма для добавлення твору') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminAddTextSubmit') }}" enctype="multipart/form-data">
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
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                            <div class="col-md-6">
                                <select id="author" class="form-control form-select @error('country') is-invalid @enderror" name="author" required>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->PIB }}</option>
                                    @endforeach 
                                </select>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Тип твору') }}</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control form-select @error('type') is-invalid @enderror" name="type" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Твір') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="file" class="form-control @error('value') is-invalid @enderror" name="value" required>

                                @error('value')
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
