@extends('admin.layouts.app')
@section('title', 'Chỉnh sửa đối tác smm')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa đối tác smm</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.service.smm.update', ['id' => $smm->id]) }}" method="POST">
                        @csrf
                        {{-- thứ tự hiển thị --}}
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="order" placeholder="Thứ tự hiển thị"
                                value="{{ $smm->order }}">
                            <label for="order">Thứ tự hiển thị</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Link SMM"
                                value="{{ $smm->name }}">
                            <label for="name">Đường link smm</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="token" placeholder="Token"
                                value="{{ $smm->token }}">
                            <label for="token">Token</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="tigia" placeholder="Tỉ giá"
                                value="{{ $smm->tigia }}">
                            <label for="tigia">Tỉ giá SMM</label>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
