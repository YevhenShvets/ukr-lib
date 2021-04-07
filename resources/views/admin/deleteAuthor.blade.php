@extends('layouts.app')

@section('title')Вилучення автора@endsection

@section('content')
<div class="container main-div">
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,255,255,0.8);">
                <div class="card-header text-center" style="font-size: 22px; background-color:rgba(254,172,14, 0.8)">{{ __('Форма для вилучення автора') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminDeleteAuthorSubmit') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                            <div class="col-md-6">
                                <select id="author" class="form-control form-select @error('country') is-invalid @enderror" name="author" required>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ (Request::input('author') == $author->id) ? 'selected' : '' }}>{{ $author->PIB }}</option>
                                    @endforeach 
                                </select>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Вилучити') }}
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
