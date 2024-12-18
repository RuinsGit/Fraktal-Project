@extends('back.layouts.master')

@section('title', 'Tərcüməni Redaktə Et')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tərcüməni Redaktə Et</h3>
            <a href="{{ route('admin.translations.index') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Geri
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.translations.update', $translation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="key">Key:</label>
                <input type="text" name="key" id="key" class="form-control @error('key') is-invalid @enderror" 
                    value="{{ old('key', $translation->key) }}" required>
                @error('key')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value_az">Value (AZ):</label>
                <textarea name="value_az" id="value_az" class="form-control @error('value_az') is-invalid @enderror" required>{{ old('value_az', $translation->value_az) }}</textarea>
                @error('value_az')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value_en">Value (EN):</label>
                <textarea name="value_en" id="value_en" class="form-control @error('value_en') is-invalid @enderror">{{ old('value_en', $translation->value_en) }}</textarea>
                @error('value_en')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value_ru">Value (RU):</label>
                <textarea name="value_ru" id="value_ru" class="form-control @error('value_ru') is-invalid @enderror">{{ old('value_ru', $translation->value_ru) }}</textarea>
                @error('value_ru')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" 
                        {{ $translation->status ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">Status</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Yadda Saxla</button>
        </form>
    </div>
</div>
@endsection