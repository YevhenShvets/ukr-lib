@extends('layouts.app')

@section('title')Редагування автора@endsection

@section('content')
<div class="container main-div">
    <div class="row justify-content-center">
    @isset($author)
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.9);">
                <div class="card-header text-center bg-info" style="font-size: 22px">{{ __('Форма для редагування автора') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminEditAuthorSubmit', $author->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="pib" class="col-md-4 col-form-label text-md-right">{{ __('ПІПб') }}</label>
                            <div class="col-md-6">
                                <input id="pib" type="text" class="form-control @error('pib') is-invalid @enderror" placeholder="Введіть піпб" name="pib" value="{{ $author->PIB }}" required autocomplete="pib" autofocus>

                                @error('pib')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Країна') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Введіть країну" value="{{ $author->country }}" name="country" required autocomplete="country">

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Опис') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="file" class="form-control @error('description') is-invalid @enderror" name="description" >

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Фото') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">

                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Редагувати') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endisset
    </div>
</div>
@endsection
