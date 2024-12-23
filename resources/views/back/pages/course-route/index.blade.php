@extends('back.layouts.master')
@section('title', 'Kurs Yolları')

@section('content')
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kurs Yolları</h6>
                <a href="{{ route('admin.course-route.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Yeni Əlavə Et
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sıra</th>
                                <th>Mətn (AZ)</th>
                                <th>Mətn (EN)</th>
                                <th>Mətn (RU)</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routes as $route)
                                <tr>
                                    <td>{{ $route->order }}</td>
                                    <td>{{ $route->text_az }}</td>
                                    <td>{{ $route->text_en }}</td>
                                    <td>{{ $route->text_ru }}</td>
                                    <td>{{ $route->link }}</td>
                                    <td>
                                        <span class="badge badge-{{ $route->status ? 'success' : 'danger' }}">
                                            {{ $route->status ? 'Aktiv' : 'Deaktiv' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.course-route.edit', $route->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.course-route.destroy', $route->id) }}" 
                                              method="POST" 
                                              class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Silmək istədiyinizdən əminsiniz?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection 