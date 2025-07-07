@extends('admin.layouts.master')
@section('title', 'Danh sách máy chủ')

@section('content')
<div class="row">

    <div class="col-md-12">
        
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tạo mới dịch vụ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.server.create') }}" method="POST">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-5">
                                            <div class="form-floating mb-3">
                                                <select name="providerName" id="providerName" class="form-select">
                                                    <option value="">Nguồn dịch vụ</option>
                                                    @foreach ($smm as $sitesmm)
                                                    <option value="{{$sitesmm['name']}}" {{ old('providerName') == $sitesmm['name'] ? 'selected' : '' }}>{{$sitesmm['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="providerName">Nguồn dịch vụ</label>
                                            </div>
                                            </div>
                                                <div class="col-md-7">
                                            <div class="form-floating mb-3">
                                                <select name="service_smm" id="service_smm" class="form-select">
                                                  

                                                    <option value="">Dịch vụ Smm</option>
                                           
                                                </select>
                                                <label for="service_smm">Dịch vụ Smm</label>
                                            </div>
                                  </div>
                                  
                                  </div>
                                  
                                  
                                  <div class="form-floating mb-3">
                                                <select name="server_smm" id="server_smm" class="form-select">
                                                  

                                                    <option value="">Máy chủ Smm</option>
                                           
                                                </select>
                                                <label for="server_smm">Máy chủ Smm</label>
                                            </div>
                                    <div class="form-floating mb-3">
                                        <select name="service" id="" class="form-select">
                                            @foreach (\App\Models\ServicePlatform::where('domain',
                                            env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $key => $platform)
                                            <option value="">-- {{ $platform->name }} --</option>
                                            @foreach ($platform->services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ old('service') == $service->id ? 'selected' : '' }}>
                                                --- {{ $service->name }} ---
                                            </option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <label for="service">Dịch vụ</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Tiêu đề máy chủ" value="{{ old('name') }}">
                                        <label for="name">Tiêu đề máy chủ</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="details" id="details" class="form-control"
                                            placeholder="Mô tả máy chủ" rows="5"
                                            style="height: 200px;">
- Bắt đầu sau : 1 giờ<br>
- ⚡Tốc độ : Ổn <br>
- ♻️Hoàn tiền : không<br>
- Định dạng : link<br>
                                                </textarea>
                                        <label for="details">Mô tả máy chủ</label>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <select name="get_uid" id="get_uid" class="form-select">
                                                    <option value="">-- Chọn trạng thái --</option>
                                                    <option value="off" selected>
                                                        Tắt</option>
                                                </select>
                                                <label for="get_uid">Tự động lấy UID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="limit_day" id="limit_day"
                                                    placeholder="Giới hạn ngày" min="0" value="0">
                                                <label for="limit_day">Giới hạn ngày (Nhập 0
                                                    thì sẽ không giới hạn)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="package_id" id="package_id" class="form-select">
                                                    <option value="">-- Chọn máy chủ --</option>
                                                    @for ($i = 1; $i <= 50; $i++) <option value="{{ $i }}"
                                                        {{ old('package_id') == $i ? 'selected' : '' }}>
                                                        Máy chủ {{ $i }}
                                                        </option>
                                                        @endfor
                                                </select>
                                                <label for="package_id">Máy chủ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="min" name="min"
                                                    value="{{ old('min') }}">
                                                <label for="min">Mua tôi thiểu</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="max" name="max"
                                                    value="{{ old('max') }}">
                                                <label for="max">Mua tôi đa</label>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="price_update"
                                                    name="price_update" value="{{ old('price_update') }}">
                                                <label for="price_update">Giá gốc</label>
                                            </div>
                                        </div>
                                    </div>
                               
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="percents" name="percents"
                                                    value="{{ old('percents') }}">
                                                <label for="percents">% số lượng đơn</label>
                                            </div>
                                 
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="price_member"
                                                    name="price_member" value="{{ old('price_member') }}">
                                                <label for="price_member">Giá thành viên</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="price_collaborator"
                                                    name="price_collaborator" value="{{ old('price_collaborator') }}">
                                                <label for="price_collaborator">Giá cộng tác viên</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="price_agency"
                                                    name="price_agency" value="{{ old('price_agency') }}">
                                                <label for="price_agency">Giá đại lý</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="price_distributor"
                                                    name="price_distributor" value="{{ old('price_distributor') }}">
                                                <label for="price_distributor">Giá nhà phân phối</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-5" hidden>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="providerLink"
                                                    name="providerLink" value="null">
                                                <label for="providerLink">Đường dẫn dịch vụ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="providerServer"
                                                    name="providerServer" value="">
                                                <label for="providerServer">Máy chủ gốc</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" hidden>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="providerKey"
                                                    name="providerKey" value="null">
                                                <label for="providerKey">Mã dịch vụ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <select name="refund_status" id="refund_status" class="form-select">
                                                        <option value="off"
                                                        {{ old('refund_status') == 'off' ? 'selected' : '' }}>
                                                        Không hoàn tiền
                                                    </option>
                                                    <option value="on"
                                                        {{ old('refund_status') == 'on' ? 'selected' : '' }}>
                                                        Có hoàn tiền
                                                    </option>
                                                
                                                </select>
                                                <label for="refund_status">Hoàn tiền</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <select name="warranty_status" id="warranty_status" class="form-select">
                                                     <option value="off"
                                                        {{ old('warranty_status') == 'off' ? 'selected' : '' }}>
                                                        Không Bảo hành
                                                    </option>
                                                    <option value="on"
                                                        {{ old('warranty_status') == 'on' ? 'selected' : '' }}>
                                                        Có Bảo hành
                                                    </option>
                                                   
                                                </select>
                                                <label for="warranty_status">Bảo hành</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" hidden>
                                            <div class="form-floating mb-3">
                                                <select name="renews_status" id="renews_status" class="form-select">
                                                      <option value="off"
                                                        {{ old('renews_status') == 'off' ? 'selected' : '' }}>
                                                        Không Gia hạn
                                                    </option>
                                                    <option value="on"
                                                        {{ old('renews_status') == 'on' ? 'selected' : '' }}>
                                                        Có Gia hạn
                                                    </option>
                                                  
                                                </select>
                                                <label for="renews_status">Gia hạn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" hidden>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="status" id="status" class="form-select">
                                                    <option value="active"
                                                        {{ old('status') == 'active' ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                        Không hoạt động
                                                    </option>
                                                </select>
                                                <label for="status">Trạng thái</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="visibility" id="visibility" class="form-select">
                                                    <option value="public"
                                                        {{ old('visibility') == 'public' ? 'selected' : '' }}>
                                                        Công khai
                                                    </option>
                                                    <option value="private"
                                                        {{ old('visibility') == 'private' ? 'selected' : '' }}>
                                                        Riêng tư
                                                    </option>
                                                </select>
                                                <label for="visibility">Hiển thị</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="reaction_status" id="reaction_status" class="form-select">
                                                    <option value="off"
                                                        {{ old('reaction_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                    <option value="on"
                                                        {{ old('reaction_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                </select>
                                                <label for="reaction_status">Cảm xúc</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="quantity_status" id="quantity_status" class="form-select">
                                                      <option value="on"
                                                        {{ old('quantity_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                    <option value="off"
                                                        {{ old('quantity_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                  
                                                </select>
                                                <label for="quantity_status">Số lượng</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="comments_status" id="comments_status" class="form-select">
                                                    <option value="off"
                                                        {{ old('comments_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                    <option value="on"
                                                        {{ old('comments_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                </select>
                                                <label for="comments_status">Bình luận</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="minutes_status" id="minutes_status" class="form-select">
                                                    <option value="off"
                                                        {{ old('minutes_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                    <option value="on"
                                                        {{ old('minutes_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                </select>
                                                <label for="minutes_status">Số phút</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div class="form-floating mb-3">
                                                <select name="time_status" id="time_status" class="form-select">
                                                    <option value="off"
                                                        {{ old('time_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                    <option value="on"
                                                        {{ old('time_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                </select>
                                                <label for="time_status">Thời gian</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="posts_status" id="posts_status" class="form-select">
                                                    <option value="off"
                                                        {{ old('posts_status') == 'off' ? 'selected' : '' }}>
                                                        Tắt
                                                    </option>
                                                    <option value="on"
                                                        {{ old('posts_status') == 'on' ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                </select>
                                                <label for="posts_status">Bài viết</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12" >
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong> Bạn
                                                cần nhập dữ liệu cảm xúc theo ví dụ như sau:
                                                <code>LIKE,HAHA,COMMENT</code> hoặc tất cả là <code>ALL</code>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="reaction_data"
                                                    name="reaction_data" value="ALL">
                                                <label for="reaction_data">Dữ liệu cảm xúc</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12" hidden>
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong>
                                                Thời gian tính theo giây và phải là số nguyên dương
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="minutes_data"
                                                    name="minutes_data" value="{{ old('minutes_data') }}">
                                                <label for="minutes_data">Dữ liệu thời gian</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Thêm máy chủ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
 

<script>
    $(document).ready(function() {
        // Khi thay đổi giá trị của select[name=actual_service]
        $('select[name=providerName]').change(function() {
            var $lam = $(this).val(); // Lấy giá trị của select actual_service
            $.ajax({
                url: "{{ route('admin.smm.checking.post') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $(this).val()
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        var serviceser = $('select[name=service_smm]');
                        
                        serviceser.empty(); // Xóa các option hiện tại trong select providerServer
                        // Duyệt qua mảng data.data và thêm từng option vào select providerServer
                        
                         serviceser.append('<option value="">Dịch vụ Smm</option>');
                        $.each(data.data, function(key, value) {
                            serviceser.append('<option value="' + $lam +'_' + value + '">' +
                                value + '</option>');
                        });
                    }
                },
                error: function(data) {
                    if (data.status == 500) {
                        toastr.error(data.responseJSON.message);
                    }
                }
            });
        });
    });
</script>

    
<script>
    $(document).ready(function() {
        // Khi thay đổi giá trị của select[name=actual_service]
        $('select[name=service_smm]').change(function() {
            var $lam = $(this).val(); // Lấy giá trị của select actual_service
            var $lamArray = $lam.split('_');
            var $firstPart = $lamArray[0];
            $.ajax({
                url: "{{ route('admin.smm.serv.checking.post') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $(this).val()
                },
                dataType: "JSON",
                success: function(data) { 
                    if (data.status == 'success') {
                        var servicesss = $('select[name=server_smm]');
                        
                        servicesss.empty(); // Xóa các option hiện tại trong select providerServer
                        // Duyệt qua mảng data.data và thêm từng option vào select providerServer
                        servicesss.append('<option value="">Máy chủ Smm</option>');
                        $.each(data.data, function(key, value) {
                            let rate;
                            if(value.money == 'VND'){
                                rate = value.rate;
                            }
                            else{
                                rate= (value.rate * 25500)/1000;
                            }
                            servicesss.append('<option value="' + $firstPart +'_' + value.service + '" >ID: [ ' +value.service +' ] ⚡️ ' + rate + ' ⚡️' +
                                value.name  +'</b></option>');
                        });
                    }
                },
                error: function(data) {
                    if (data.status == 500) {
                        toastr.error(data.responseJSON.message);
                    }
                }
            });
        });
    });
</script>

    
    
    
    <script>
        $(document).ready(function() {
            //change actual_service value
            $('select[name=server_smm]').change(function() {
                $.ajax({
                    url: "{{ route('admin.smm.service.checking.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $(this).val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                      if (data.status == 'success') {
    var providerServer = $('input[name=providerServer]').parent();
    var min = $('input[name=min]').parent();
    var max = $('input[name=max]').parent();
    var price = $('input[name=price_member]').parent();
    var price_collaborator = $('input[name=price_collaborator]').parent();
    var price_agency = $('input[name=price_agency]').parent();
    var price_distributor = $('input[name=price_distributor]').parent();
    var title = $('input[name=name]').parent();
    var price_update = $('input[name=price_update]').parent();
    // Xóa các thẻ input hiện có
    title.empty();
    min.empty();
     price_update.empty();
    max.empty();
     price.empty();
     price_agency.empty();
     price_collaborator.empty();
     price_distributor.empty();
    providerServer.empty();
let pricenew;
let price_agency_new;
let price_collaborator_new;
let price_distributor_new;
var percent_price = {{ siteValue('price') }};
var percent_price_collaborator = {{ siteValue('price_collaborator') }};
var percent_price_agency = {{ siteValue('price_agency') }};
var percent_price_distributor = {{ siteValue('price_distributor') }};
if(data.data.money == 'VND'){
    price_update_new = (data.data.rate/1000);
    pricenew = (data.data.rate/1000) + (data.data.rate/1000)*(percent_price/ 100);
    price_collaborator_new = (data.data.rate/1000) + (data.data.rate/1000)*(percent_price_collaborator/ 100);
    price_agency_new = (data.data.rate/1000) + (data.data.rate/1000)*(percent_price_agency/ 100);
    price_distributor_new = (data.data.rate/1000) + (data.data.rate/1000)*(percent_price_distributor/ 100);
}
else{
    price_update_new = ((data.data.rate * 25500)/1000);
pricenew = ((data.data.rate * 25500)/1000) + ((data.data.rate * 25500)/1000)*(percent_price/ 100);
    price_collaborator_new = ((data.data.rate * 25500)/1000) + ((data.data.rate * 25500)/1000)*(percent_price_collaborator/ 100);
    price_agency_new = ((data.data.rate * 25500)/1000) + ((data.data.rate * 25500)/1000)*(percent_price_agency/ 100);
    price_distributor_new = ((data.data.rate * 25500)/1000) + ((data.data.rate * 25500)/1000)*(percent_price_distributor/100);
}

    
        min.append('<input type="text" class="form-control " name="min" value="' + data.data.min + '">   <label><i class=""></i><span class=" ps-3">Mua tối thiểu</span></label>');
        price_update.append('<input type="text" class="form-control " name="price_update" value="' + price_update_new + '">   <label><i class=""></i><span class=" ps-3">Giá gốc</span></label>');
        price.append('<input type="text" class="form-control " name="price_member" value="' + pricenew.toFixed(2) + '">   <label><i class=""></i><span class=" ps-3">Giá thành viên</span></label>');

        price_collaborator.append('<input type="text" class="form-control " name="price_collaborator" value="' + price_collaborator_new.toFixed(2) + '">   <label><i class=""></i><span class=" ps-3">Giá cộng tác viên</span></label>');
        
        price_agency.append('<input type="text" class="form-control " name="price_agency" value="' + price_agency_new.toFixed(2) + '">   <label><i class=""></i><span class=" ps-3">Giá đại lý</span></label>');
        
        price_distributor.append('<input type="text" class="form-control " name="price_distributor" value="' + price_distributor_new.toFixed(2) + '">   <label><i class=""></i><span class=" ps-3">Giá nhà phân phối</span></label>');
        
         title.append('<input type="text" class="form-control " name="name" value="' + data.data.name + '">   <label><i class=""></i><span class=" ps-3">Tiêu đề</span></label>');
        providerServer.append('<input type="text" class="form-control" id="providerServer" name="providerServer" value="'+data.data.service+'"><label for="providerServer">Máy chủ gốc</label>');
        max.append('<input type="text" class="form-control " name="max" value="' + data.data.max + '">   <label><i class=""></i><span class=" ps-3">Mua tối đa</span></label>');
    
}


                    },
                    error: function(data) {
                        if (data.status == 500) {
                            toastr.error(data.responseJSON.message);
                        }
                    }
                })
            })
        });
    </script>
    
    
    

     
@endsection