@extends('back.layouts.master')

@section('title', 'Yeni Kurs Növü')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Yeni Kurs Növü</h3>
            <a href="{{ route('admin.course-types.index') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Geri
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.course-types.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Ad (AZ)</label>
                <input type="text" name="name_az" class="form-control @error('name_az') is-invalid @enderror" value="{{ old('name_az') }}">
                @error('name_az')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Ad (EN)</label>
                <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}">
                @error('name_en')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Ad (RU)</label>
                <input type="text" name="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ old('name_ru') }}">
                @error('name_ru')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
                    <label class="custom-control-label" for="status">Status</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Yadda Saxla</button>
        </form>
    </div>
</div>
@endsection 