@extends('layouts.app')

@section('title')Редагування контакту@endsection

@section('content')
@isset($contact)
<div class="container main-div" style="margin-bottom:100px;">
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.9);">
                <div class="card-header text-center bg-info" style="font-size: 22px">{{ __('Форма для редагування контакту') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminEditContactSubmit', $contact->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="pib" class="col-md-4 col-form-label text-md-right">{{ __('ПІПб') }}</label>
                            <div class="col-md-6">
                                <input id="pib" type="text" class="form-control" placeholder="Введіть піпб" name="pib" value="{{ $contact->pib }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Посада') }}</label>
                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control" placeholder="Введіть посаду" name="position" value="{{ $contact->position }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('Відділ') }}</label>
                            <div class="col-md-6">
                                <input id="section" type="text" class="form-control" placeholder="Введіть відділ" name="section" value="{{ $contact->section }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефону') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" placeholder="Введіть номер телефону" name="phone" value="{{ $contact->phone }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" placeholder="Введіть email" name="email" value="{{ $contact->email }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Фото') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
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
    </div>
</div>
@endisset
@endsection
