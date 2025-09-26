@extends('layouts.app') {{-- Ganti dengan nama file layout utama Anda --}}

@section('content')
<div class="container my-5">

    {{-- HEADER DEPARTEMEN --}}
    <section class="text-center mb-5">
        <h1 class="display-4 fw-bold text-uppercase">{{ $department->name }}</h1>
        <p class="lead text-muted">Mengenal lebih dekat struktur dan program kerja kami.</p>
    </section>

    {{-- Cek jika detail departemen ada --}}
    @if ($department->detail)
        
    {{-- KETUA DEPARTEMEN --}}
    <section class="mb-5 p-4 bg-light rounded-3">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <img src="{{ asset($department->detail->head_photo) }}" class="img-fluid rounded-circle shadow" alt="Foto {{ $department->detail->head_name }}" style="width: 180px; height: 180px; object-fit: cover;">
            </div>
            <div class="col-md-9">
                <h2 class="fw-bold">{{ $department->detail->head_name }}</h2>
                <h4 class="text-muted mb-3">Ketua Departemen</h4>
                <blockquote class="blockquote fst-italic">
                    <p>"{{ $department->detail->division_words }}"</p>
                </blockquote>
            </div>
        </div>
    </section>

    {{-- SUB-DEPARTEMEN DAN PROGRAM KERJA --}}
    <section>
        <h2 class="text-center fw-bold mb-5">Struktur Divisi & Program Kerja</h2>
        
        {{-- PERBAIKAN: Loop dari relasi subDepartments() --}}
        @forelse ($department->subDepartments as $subDept)
            <div class="mb-5">
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                         {{-- Mengambil data dari objek $subDept --}}
                         <img src="{{ asset($subDept->sub_department_photo) }}" class="img-fluid rounded-circle" alt="Foto {{ $subDept->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                    <div class="col">
                        <h3 class="fw-bold border-bottom pb-2">{{ $subDept->name }}</h3>
                    </div>
                </div>

                {{-- Loop untuk setiap Program Kerja --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($subDept->work_programs as $proker)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $proker['title'] }}</h5>
                                <p class="card-text">{{ $proker['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col">
                        <p class="text-muted">Belum ada program kerja untuk divisi ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="text-center p-5 bg-light rounded">
                <p class="lead">Belum ada data sub-departemen untuk ditampilkan.</p>
            </div>
        @endforelse
    </section>

    @else
    <div class="text-center p-5 bg-light rounded">
        <p class="lead">Detail untuk departemen ini belum tersedia.</p>
    </div>
    @endif

</div>
@endsection
