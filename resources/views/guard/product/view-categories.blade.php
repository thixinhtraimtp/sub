@extends('guard.layouts.app')
@section('title', 'Mua tài khoản')
@section('content')
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="card border shadow">
                    <div class="card-body p-3">
                        <a href="{{ route('product.category', ['slug' => $category->slug]) }}">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-l">
                                    <img src="{{ asset(json_decode($category->image, true)[0] ?? 'images/default-image.jpg') }}" class="img-fluid" alt="{{ $category->name }}">

                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold fs-8 text-dark">{{ $category->name }}</p>
                                    <p class="text-muted fs-9 mb-1">{!! substr($category->note, 0, 50) !!}</p>
                                    <div>
                                        <span class="badge bg-light-secondary">{{ number_format($category->price) }} VNĐ</span>
                                        <span class="badge bg-light-secondary">Còn lại <span
                                                class="text-success">{{ number_format($category->products->where('status', 'selling')->count()) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
