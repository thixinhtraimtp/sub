@extends('admin.layouts.app')
@section('title', 'Chỉnh sửa danh mục sản phẩm')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <form action="{{ route('admin.product.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4 class="card-title text-center">Chỉnh sửa danh mục sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Tên danh mục</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-md-2 col-form-label">Đường dẫn</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Hình ảnh</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control mb-3" id="image" name="image[]" multiple>
                                @if($category->image)
                                    <div class="row">
                                        @foreach(json_decode($category->image, true) as $image)
                                            <div class="col-md-3">
                                                <img src="{{ asset($image) }}" alt="" class="img-thumbnail" width="100px">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-md-2 col-form-label">Ghi chú</label>
                            <div class="col-md-10">
                                <textarea name="note" id="note" class="form-control" rows="5">{!! $category->note !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label">Mô tả</label>
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control" rows="5">{!! $category->description !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label">Giá tiền</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="price" name="price" value="{{ $category->price }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-gradient mr-1">Cập nhật</button>
                        <a href="http://127.0.0.1:8000/admin/product/category" class="btn btn-danger-gradient">
                            <i class="ti ti-arrow-back"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="/assets/js/plugins/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            height: '400',
            selector: '#description',
            content_style: 'body { font-family: "Inter", sans-serif; }',
            menubar: false,
            toolbar: [
                'styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
            ],
            plugins: 'advlist autolink link image lists charmap print preview code'
        });
    </script>
@endsection
