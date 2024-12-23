@extends('back.layouts.master')
@section('title', 'Kurs Yolunu Redaktə Et')

@section('content')
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kurs Yolunu Redaktə Et</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-route.update', $route->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="text_az">Mətn (AZ)</label>
                                <input type="text" name="text_az" id="text_az" 
                                       class="form-control @error('text_az') is-invalid @enderror" 
                                       value="{{ old('text_az', $route->text_az) }}" required>
                                @error('text_az')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="text_en">Mətn (EN)</label>
                                <input type="text" name="text_en" id="text_en" 
                                       class="form-control @error('text_en') is-invalid @enderror" 
                                       value="{{ old('text_en', $route->text_en) }}" required>
                                @error('text_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="text_ru">Mətn (RU)</label>
                                <input type="text" name="text_ru" id="text_ru" 
                                       class="form-control @error('text_ru') is-invalid @enderror" 
                                       value="{{ old('text_ru', $route->text_ru) }}" required>
                                @error('text_ru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" id="link" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       value="{{ old('link', $route->link) }}" required>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="order">Sıra</label>
                                <input type="number" name="order" id="order" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       value="{{ old('order', $route->order) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <!-- <label for="status">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $route->status) == '1' ? 'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ old('status', $route->status) == '0' ? 'selected' : '' }}>Deaktiv</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;">Yadda Saxla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 