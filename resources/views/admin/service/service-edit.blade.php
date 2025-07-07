@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa dịch vụ')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa dịch vụ</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.service.update', ['id' => $service->id]) }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <select name="platform_id" id="platform_id" class="form-select">
                                <option>-- Chọn nền tảng --</option>
                                @foreach (\App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $platform)
                                    <option value="{{ $platform->id }}" @if (old('platform_id') == $platform->id) selected @endif>
                                        {{ $platform->name }}</option>
                                @endforeach
                            </select>
                            <label for="platform_id">Chọn nền tảng</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="package" id="package" class="form-control"
                                placeholder="Mã dịch vụ" value="{{ old('package') ?? $service->package }}">
                            <label for="name">Mã dịch vụ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Tên dịch vụ" value="{{ old('name') ?? $service->name }}">
                            <label for="name">Tên dịch vụ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="image" name="image"
                                placeholder="Tên dịch vụ" value="{{ $service->image }}">
                            <label for="image">Image</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug"
                                value="{{ old('slug') ?? $service->slug }}">
                            <label for="slug">Đường dẫn</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="note" id="note" class="form-control" placeholder="Ghi chú" style="height: 100px">{{ old('note') ?? $service->note }}</textarea>
                            <label for="note">Ghi chú</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="details" id="details" class="form-control" placeholder="Lưu ý" style="height: 100px">{{ old('details') ?? $service->details }}</textarea>
                            <label for="details">Lưu ý</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="blogs" id="blogs" class="form-control" cols="30" rows="8" style="height: 120px;">{{ old('blogs') ?? $service->blogs }}</textarea>
                            <label for="blogs">Bài viết</label>
                        </div>

                        <div class="row" hidden>
                            <h5 class="mb-3">Hiển thị dữ liệu trong bảng </h5>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="reaction_status" id="" class="form-select">
                                        <option value="off" @if (old('reaction_status') == 'off' || $service->reaction_status == 'off') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('reaction_status') == 'on' || $service->reaction_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột cảm xúc</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="quantity_status" id="" class="form-select">
                                        <option value="off" @if (old('quantity_status') == 'off' || $service->quantity_status == 'off') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('quantity_status') == 'on' || $service->quantity_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột số lượng</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="comments_status" id="" class="form-select">
                                        <option value="off" @if (old('comments_status') == 'on' || $service->comments_status == 'on') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('comments_status') == 'on' || $service->comments_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột bình luận</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="minutes_status" id="" class="form-select">
                                        <option value="off" @if (old('minutes_status') == 'off' || $service->minutes_status == 'off') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('minutes_status') == 'on' || $service->minutes_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột số phút</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="time_status" id="" class="form-select">
                                        <option value="off" @if (old('time_status') == 'off' || $service->time_status == 'off') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('time_status') == 'on' || $service->time_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột thời gian</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="posts_status" id="" class="form-select">
                                        <option value="off" @if (old('posts_status') == 'off' || $service->posts_status == 'off') selected @endif>Tắt
                                        </option>
                                        <option value="on" @if (old('posts_status') == 'on' || $service->posts_status == 'on') selected @endif>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột bài viết</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-floating mb-3">
                            <select name="status" id="status" class="form-select">
                                <option value="active" @if (old('status') == 'active' || $service->status == 'active') selected @endif>Hoạt
                                    động</option>
                                <option value="inactive" @if (old('status') == 'inactive' || $service->status == 'inactive') selected @endif>Không
                                    hoạt động</option>
                            </select>
                            <label for="status">Trạng thái</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Lưu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('script')
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    height: '400',
    selector: '#blogs',
    content_style: 'body { font-family: "Inter", sans-serif; }',
    menubar: false,
    toolbar: [
        'styleselect fontselect fontsizeselect',
        'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | forecolor backcolor |',
        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
    ],
    plugins: 'advlist autolink link image lists charmap print preview code'
});
</script>
@endsection
@endsection
