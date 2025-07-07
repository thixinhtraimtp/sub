@extends('guard.layouts.main')
@section('content')
@section('title', 'Đặt hàng')
<section class="lg:py-12 py-6">
    <form action="{{ route('api.create.order') }}" method="POST" lamtilo-request="order">
        <div class="container">
            <div class="grid xl:grid-cols-3 gap-5">
                <div class="xl:col-span-2">
                    <div class="rounded-lg border border-default-200 bg-white dark:bg-default-50 shadow p-3 mt-5" style="position: relative">
                        <div class="ribbon">
                            <span class="text-sm font-semibold text-white">KHỞI TẠO ĐƠN HÀNG</span>
                        </div>
                        <input type="hidden" id="provider_package" name="provider_package" value="">
                        <div class="form-group mb-3">
                            <label for="object_id" class="block text-sm font-medium text-default-900 mb-2 mt-9">Link Hoặc UID:</label>
                            <input type="text" class="block w-full rounded-md py-2.5 px-4 text-default-800  focus:ring-transparent border-default-200 dark:bg-default-50" id="object_id" name="object_id" placeholder="Nhập link hoặc ID tuỳ các máy chủ">
                        </div>
                        <div class="grid xl:grid-cols-3 gap-5">
                            <div class="form-group mb-3">
                                <select name="platforms" id="platforms" class="block w-full rounded-md py-2.5 px-4 text-default-800 focus:ring-transparent border-default-200 dark:bg-default-50">
                                    <option value="" >-- Chọn nền tảng --</option>
                                @foreach (\App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get() as $platform)
                                @if ($platform->status == 'active')
                                    <option value="{{ $platform->id }}" data-image="{{ $platform->image }}">{{ $platform->name }}</option>
                                @endif
                            @endforeach
                                </select>
                            </div>
                            <div class="xl:col-span-2">
                                <div class="form-group mb-3">
                                    <select name="services" id="services" class="block w-full rounded-md py-2.5 px-4 text-default-800 focus:ring-transparent border-default-200 dark:bg-default-50">
                                        <option value="" data-image="">-- Chọn dịch vụ --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <div id="loading-message" style="display:none;">
                                <div class="animate-spin w-8 h-8 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading"></div>
                            </div>
                        </div>
                        <div class="scroll-notification" style="max-height: 300px">
                            <div id="input-fields" class="form-group mb-3"></div>
                        </div>
                        <div class="form-group mb-3 reactions" id="reactions_type" style="display: none;">
                            <label class="block text-sm font-medium text-default-900 mb-2">Cảm xúc:</label>
                            <div class="flex items-center justify-center mt-5 gap-5">
                                <div class=" form-check form-check-inline">
                                    <label class="form-check-label " for="reaction0">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio" data-prices="101" id="reaction0" name="reaction" value="like" checked="">
                                        <img src="/assets/pack-lamtilo/reaction/like.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction1">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction1" name="reaction" value="love">
                                        <img src="/assets/pack-lamtilo/reaction/love.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction2">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction2" name="reaction" value="care">
                                        <img src="/assets/pack-lamtilo/reaction/care.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction3">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction3" name="reaction" value="haha">
                                        <img src="/assets/pack-lamtilo/reaction/haha.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction4">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction4" name="reaction" value="wow">
                                        <img src="/assets/pack-lamtilo/reaction/wow.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction6">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction6" name="reaction" value="sad">
                                        <img src="/assets/pack-lamtilo/reaction/sad.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="reaction7">
                                        <input class="form-check-input checkbox d-none border-default-200 text-primary input-light-primary" type="radio"
                                            data-prices="100" id="reaction7" name="reaction" value="angry">
                                        <img src="/assets/pack-lamtilo/reaction/angry.png"
                                            alt="image" class="d-block ml-2 rounded-circle" width="35">
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid lg:grid-cols-1 gap-2 mt-3">
                            <div class="relative w-full lg:w-full">
                                <input type="number" class="block py-4 ps-4 pe-20 w-full h-12 rounded-md text-default-800 text-sm focus:ring-transparent border-default-200 dark:bg-default-50" id="quantity" name="quantity" value="" onkeyup="checkPrice()" placeholder="Nhập số lượng">
                                <button style="box-shadow: 0px 3px 0px #0b7452" class="inline-flex items-center justify-center gap-2 px-6 absolute top-[6px] end-[6px] h-9 transition-all bg-primary-500 hover:bg-primary-600 border-primary-500 hover:border-primary-600 text-white rounded-md duration-200" type="button" id="btn-reload-token">
                                   <p class="text-default-900 font-bold"><span id="total_pay" onkeyup="checkPrice()" >0<span></p><p class="text-default-900 font-bold">đ</p>
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-3 comments" id="comments_type" style="display: none;">
                            <label for="comments" class="block text-sm font-medium text-default-900 mb-2"> Nội dung bình luận: 
                                <span id="counter_comment" class="badge bg-success py-1">0</span>
                                <span id="quantity_limitss">(0 ~ 0)</span>
                                <div class="mt-5 border border-yellow-600 bg-yellow-600/10 text-yellow-600 border-dashed rounded-md px-4 py-3 w-full" id="" style="border-width: 2px">
                                    <strong>Lưu ý:</strong> 
                                        Nếu bạn nhập nhiều bình luận, hệ thống sẽ chọn ngẫu
                                        nhiên 1 bình
                                        luận trong số đó để tăng
                                        <br>
                                        Các ngôn từ bị cấm: dm |đm |đ m | d m | địt mẹ | dit
                                        me | lol | lừađảo | conchó | trảtiền | mấtdạy | lừa đảo | con chó | trả tiền | mất dạy | lua
                                        dao | con cho | tra tien | mat day
                                </div>
                            </label>
                            <textarea class="block w-full rounded-md py-2.5 px-4 text-default-800  focus:ring-transparent border-default-200 dark:bg-default-50" name="comments" id="comments" rows="3" placeholder="Nhập nội dung bình luận" onkeyup="checkPrice()"></textarea>
                        </div>
                        <div class="form-group mb-3 minute" id="minute_type" style="display: none;">
                            <label for="minute" class="block text-sm font-medium text-default-900 mb-2">Số phút</label>
                            <select name="minutes" class="block w-full rounded-md py-2.5 px-4 text-default-800  focus:ring-transparent border-default-200 dark:bg-default-50" onchange="checkPrice()">
                                <option value="15">15 phút</option>
                                <option value="30">30 phút</option>
                                <option value="60">60 phút</option>
                                <option value="90">90 phút</option>
                                <option value="120">120 phút</option>
                                <option value="150">150 phút</option>
                                <option value="180">180 phút</option>
                                <option value="210">210 phút</option>
                                <option value="240">240 phút</option>
                                <option value="270">270 phút</option>
                                <option value="300">300 phút</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="time_type" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="duration" class="block text-sm font-medium text-default-900 mb-2">Thời gian:</label>
                                    <select name="duration" id="duration" class="block w-full rounded-md py-2.5 px-4 text-default-800  focus:ring-transparent border-default-200 dark:bg-default-50"
                                        onchange="checkPrice()">
                                        
                                        <option value="30">30 Ngày</option>
                                        <option value="60">60 Ngày</option>
                                        <option value="90">90 Ngày</option>
                                        <option value="120">120 Ngày</option>
                                        <option value="150">150 Ngày</option>
                                        <option value="180">180 Ngày</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3" id="posts_type" style="display: none;">
                                    <label for="posts" class="block text-sm font-medium text-default-900 mb-2">Số bài viết:</label>
                                
                                    <select name="posts" id="posts" class="block w-full rounded-md py-2.5 px-4 text-default-800  focus:ring-transparent border-default-200 dark:bg-default-50">
                                        <option value="unlimited">Không giới hạn</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 mt-3">
                            <label for="note" class="block text-sm font-medium text-default-900 mb-2">Ghi chú:</label>
                            <textarea class="form-input bg-transparent rounded w-full border border-default-200 mb-4 focus:border-primary focus:ring-0" name="note" id="note" rows="3" placeholder="Nhập ghi chú nếu cần"></textarea>
                        </div>
                        <div class="form-group">
                            @if (Auth::check())
                            <button type="submit" class="w-full py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md" style="box-shadow: 0px 3px 0px #0b7452">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Tạo đơn hàng</span>
                            </button>
                            @else
                            <a href="{{route('login')}}" class="w-full py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md" style="box-shadow: 0px 3px 0px #0b7452">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Đăng nhập để mua dịch vụ!</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3" style="position: relative">
                    <div class="ribbon">
                        <span class="text-sm font-semibold text-white">GHI CHÚ</span>
                    </div>
                    <div class="rounded-lg border border-default-200 bg-white dark:bg-default-50 shadow overflow-hidden">
                        <div class="p-2 mt-9">
                            <div class="scroll-notification" style="max-height: 300px">
                                <div class="flex flex-col flex-wrap gap-2 p-2">
                                    <div class="rounded-lg border border-default-200 bg-white dark:bg-default-50 overflow-hidden">
                                        <div class="p-5">
                                            <div class="flex gap-4">
                                                <div class="grow">
                                                    <span class="text-sm font-semibold text-default-900"><p id="service_note" name="note" value=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                <div>
                <div>
                    <div class="mt-5 border border-red-600/20 bg-red-600/10 text-red-600 text-sm font-semibold border-dashed rounded-md px-4 py-3 w-full" role="alert" style="border-width:2px">
                        <b class="text-lg">Lưu ý!</b>
<p>- Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp luật.</p>
<p>- Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác hoặc đè nhiều đơn, nếu có tình trạng hụt, thiếu số lượng giữa 2 bên thì sẽ không được xử lí.
<p>- Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền.
<p>- Nếu gặp lỗi hãy nhắn tin hỗ trợ phía bên phải góc màn hình hoặc vào mục liên hệ hỗ trợ để được hỗ trợ tốt nhất.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
@endsection
@section('script')
<style> .swal2-popup .swal2-html-container { text-align: center; /* Căn trái văn bản */ } .swal2-popup { position: relative; } .custom-button { position: absolute; bottom: 20px; right: 20px; } div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm { border: 0; border-radius: .25em; background: initial; background-color: hsl(var(--twc-primary) / var(--twc-primary-opacity, var(--tw-text-opacity))); color: #fff; font-size: 1em } .custom-button:hover { background-color: #10b981; border-color: #0056b3; }</style>
<script>
    window.onload = function() {
        Swal.fire({
            html: `
                <div class="flex items-center justify-center">
                <p class="text-xl font-semibold text-default-900">THÔNG BÁO!</p>
                </div>
                <p class="font-semibold text-default-900 mt-2">Hiện tại Facebook đang quét rất căng có thể nghẽn đơn lâu rồi mới chạy mọi người vui lòng test số lượng nhỏ trước khi lên đơn lớn ạ!</p>
                <p class="font-semibold text-default-900 mt-2">Mọi vấn đề cần hỗ trợ vui lòng liên hệ qua <a class="text-primary-600"href="{{siteValue('zalo')}}">Zalo</a> hoặc ấn vào nút bên góc phải màn hình để liên hệ Admin!</p>

            `,
            confirmButtonText: 'Đóng',
            customClass: {
                confirmButton: 'swal2-confirm btn btn-primary custom-button'
            }
        });
    };
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {
    $('#platforms').select2({
      placeholder: '-- Chọn nền tảng --',
      allowClear: true
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#platforms').select2({
      placeholder: '-- Chọn nền tảng --',
      allowClear: true
    });

    $('#platforms').on('change', function () {
      const platform = $(this).val();
      const servicesSelect = $('#services');
      const inputFields = $('#input-fields');
      
      servicesSelect.empty();
      servicesSelect.append('<option value="" data-image="">-- Chọn dịch vụ --</option>');
      inputFields.empty();
      
      let services = [];
      @foreach (\App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get() as $platform)
        if (platform === '{{ $platform->id }}') {
          services = [
            @foreach ($platform->services as $service)
              {
                value: '{{ $service->id }}',
                'data-image': '{{ $service->image }}',
                note: `{!! $service->note !!}`,
                text: '{{ $service->name }}'
              },
            @endforeach
          ];
        }
      @endforeach

      services.forEach(function (service) {
        const option = new Option(service.text, service.value);
        $(option).attr('data-image', service['data-image']);
        $(option).attr('data-note', service.note);
        servicesSelect.append(option);
      });

      servicesSelect.select2({
        placeholder: '-- Chọn dịch vụ --',
        allowClear: true,
        templateResult: formatState,
        templateSelection: formatState
      });

      servicesSelect.on('change', function () {
        const service = $(this).val();
        inputFields.empty();
        const selectedOption = $(this).find('option:selected');
        const note = selectedOption.attr('data-note');

        if (note) {
          $('#service_note').html(note);
        } else {
          $('#service_note').html('');
        }

        if (service !== "") {
          @foreach (\App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get() as $platform)
            @foreach ($platform->services->where('domain', request()->getHost()) as $serviceItem)
              if (service === '{{ $serviceItem->id }}') {
                $('#provider_package').val('{{ $serviceItem->package }}');
                inputFields.append(`
                  @foreach ($serviceItem->servers->where('domain', request()->getHost()) as $server)
                    <div class="mb-1">
                      <div class="form-check mb-2 d-flex align-items-center gap-2">
                        <input type="radio" class="form-check-input rounded bg-transparent border-default-200 text-primary" 
                            id="provider-server-{{ $server->package_id }}" 
                            value="{{ $server->package_id }} " 
                            name="provider_server" 
                            platform="{{ $platform->id }}" 
                            provider_package="{{ $serviceItem->package }}" 
                            data-details="{{ $server->details }}" 
                            data-min="{{ $server->min }}" 
                            data-max="{{ $server->max }}" 
                            data-quantity="{{ $server->action->quantity_status }}" 
                            data-reaction="{{ $server->action->reaction_status }}" 
                            data-comment="{{ $server->action->comments_status }}" 
                            data-getuid="{{ $server->action->get_uid }}" 
                            data-minute="{{ $server->action->minutes_status }}" 
                            data-reaction_type="{{ $server->action->reaction_data ?? 'all' }}" 
                            data-comment_type="{{ $server->action->comments_data }}" 
                            data-minute_type="{{ $server->action->minutes_data }}" 
                            data-posts="{{ $server->action->posts_status }}" 
                            data-posts_type="{{ $server->action->posts_data }}" 
                            data-time="{{ $server->action->time_status }}" 
                            data-time_type="{{ $server->action->time_data }}" 
                            @if (Auth::check()) 
                                data-price="{{ $server->levelPrice(Auth::user()->level) }}" 
                            @else data-price="{{ $server->price_member}}" 
                            @endif 
                            onclick="checkPrice()">
                        <label class="form-check-label text-dark" for="provider-server-{{ $server->package_id }}">
                          <span class="inline-flex items-center gap-x-1.5 px-2 rounded-lg text-sm font-bold bg-primary text-white">MC: {{ $server->id }} </span>
                          <span class="text-default-900 text-sm font-semibold">- {!! ucwords($server->name) !!}</span>
                          @if ($server->status === 'inactive')
                            <span class="inline-flex items-center gap-x-1.5 px-2 rounded-lg text-sm font-semibold bg-red-600 text-white">Bảo trì</span>
                          @endif
                          @if ($server->limit_day > 0)
                            <span class="inline-flex items-center gap-x-1.5 px-2 rounded-lg text-sm font-semibold bg-yellow-600 text-white">Giới hạn: {{ number_format($server->limit_day) }} đơn/ Ngày</span>
                          @endif
                          <span class="inline-flex items-center gap-x-1.5 px-2 rounded-lg text-sm font-semibold bg-sky-600 text-white">
                            @if (Auth::check()) {{ $server->levelPrice(Auth::user()->level) }}đ @else {{ $server->price_member }}đ @endif
                          </span>
                        </label>
                      </div>
                    </div>
                  @endforeach
                `);
              }
            @endforeach
          @endforeach
        }
      });
    });

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
      var $state = $('<span><img src="' + $(state.element).data('image') + '" style="width: 24px; height: 24px; margin-right: 10px; vertical-align: middle; display: inline-block;" /> ' + state.text + '</span>');
      return $state;
    }
  });
</script>

<script>
  $(document).ready(function () {
    $('#platforms, #services').select2({
      allowClear: true,
      templateResult: formatState,
      templateSelection: formatState
    });

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
      var $state = $('<span><img src="' + $(state.element).data('image') + '" style="width: 24px; height: 24px; margin-right: 10px; vertical-align: middle; display: inline-block;" /> ' + state.text + '</span>');
      return $state;
    }
  });
</script>

<script src="{{ asset('assets/pack-lamtilo/js/service1.js?time=') }}{{ time() }}"></script>
@endsection
