@extends('guard.layouts.main')
@section('title', 'Điều khoản dịch vụ')
@section('content')
<section class="lg:py-12 py-6">
  <div class="container">
    <div class="grid xl:grid-cols-1 gap-6">
      <div class="rounded-lg border border-default-200 bg-white dark:bg-default-50 overflow-hidden">
        <div class="p-5">
          <h5 class="text-red-600 text-xl font-bold text-center">KHI BẠN SỬA DỤNG WEBSITE {{site('name_site')}}</h5>
          <h5 class="text-default-900 text-lg font-bold text-center">Có nghĩa là bạn đồng ý với các điều khoản dưới đây!</h5><br>

          <div class="list-group">
            <!-- Quy định về tiền -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">QUY ĐỊNH VỀ TIỀN TRÊN WEBSITE</p>
              <ul class="font-semibold">
                <li>Giá trị quy đổi tương đương tiền tệ VNĐ, tỉ giá giao động theo thị trường.</li>
                <li>Hình thức nạp tiền vào website là hoàn toàn tự nguyện, dùng để sử dụng các dịch vụ được cung cấp trên website.</li>
                <li>Khi nạp tiền vào website người dùng sẽ nhận được số tiền tương ứng (có thể thêm khuyến mãi từ admin) và số tiền này không thể quy đổi ngược lại.</li>
              </ul>
            </div>

            <!-- Quy định đơn hàng -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">QUY ĐỊNH ĐƠN HÀNG</p>
              <ul class="font-semibold">
                <li>Nên chạy test số lượng nhỏ để chọn dịch vụ phù hợp.</li>
                <li>Bắt buộc đọc kĩ thông tin máy chủ (chọn server sẽ hiện).</li>
                <li>Yêu cầu cài dịch vụ đúng thông tin máy chủ yêu cầu.</li>
                <li>Phần tốc độ chỉ để tham khảo, KHÔNG chính xác 100%.</li>
                <li>Mỗi dịch vụ có các quy định khác nhau, xem chi tiết tại thông tin máy chủ của dịch vụ trước khi sử dụng.</li>
                <li>Các dịch vụ có quy định và cách thức hoạt động có thể thay đổi theo thời gian.</li>
                <li>Các đơn hàng báo lỗi, báo huỷ liên hệ admin để được kiểm tra và xử lý.</li>
              </ul>
            </div>

            <!-- Quy định chất lượng dịch vụ -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">QUY ĐỊNH CHẤT LƯỢNG DỊCH VỤ</p>
              <ul class="font-semibold">
                <li>Website chúng tôi nghiên về hướng cung cấp dịch vụ GIÁ RẺ, có các loại như sau:</li>
                <li><strong>Không Bảo Hành</strong>: Dịch vụ có rủi ro, đơn có thể không chạy hoặc không đạt yêu cầu (không hỗ trợ hoàn tiền).</li>
                <li><strong>Có Bảo Hành</strong>: Dịch vụ có bảo hành trong thời gian ghi trên thông tin máy chủ (lên thiếu hoặc không lên có thể yêu cầu bảo hành).</li>
                <li>Bạn có thể yêu cầu thêm bảo hành cho dịch vụ không có bảo hành.</li>
                <li>Đơn hàng không bảo hành nhưng gửi admin có thể xem xét hỗ trợ hoàn tiền.</li>
                <li>Mọi quyết định cuối cùng đều do admin quyết định.</li>
              </ul>
            </div>

            <!-- Quy định đối với khách hàng -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">ĐỐI VỚI BÊN KHÁCH HÀNG</p>
              <ul class="font-semibold">
                <li>Không sử dụng các nội dung vi phạm pháp luật, chính trị, đồi truỵ,... Vi phạm sẽ bị khóa tài khoản và chịu trách nhiệm trước pháp luật.</li>
                <li>Có thể báo cáo các dịch vụ không đạt hiệu quả tại mục hỗ trợ.</li>
              </ul>
            </div>

            <!-- Quy định đối với admin -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">ĐỐI VỚI BÊN ADMIN</p>
              <ul class="font-semibold">
                <li>Chúng tôi có trách nhiệm hoàn thành các dịch vụ đã yêu cầu.</li>
                <li>Tiếp nhận và xử lý các lỗi do người dùng báo cáo.</li>
                <li>Từ chối hỗ trợ các ID vi phạm hoặc không thực hiện theo hướng dẫn.</li>
              </ul>
            </div>

            <!-- Quy định yêu cầu hỗ trợ đơn -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">QUY ĐỊNH VỀ YÊU CẦU HỖ TRỢ ĐƠN</p>
              <ul class="font-semibold">
                <li>Khi yêu cầu hỗ trợ, vui lòng nhắn thẳng vào vấn đề cần hỗ trợ.</li>
                <li>Gửi mã đơn hàng (gửi riêng, không ghi chung dòng).</li>
                <li>Miêu tả rõ ràng vấn đề bạn gặp phải để admin có thể hỗ trợ tốt nhất.</li>
              </ul>
            </div>

            <!-- Chính sách bảo mật -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">QUY ĐỊNH, CHÍNH SÁCH BẢO MẬT</p>
              <ul class="font-semibold">
                <li>Chúng tôi thu thập các thông tin người dùng như: số điện thoại, email, IP, các ID và nội dung dịch vụ,...</li>
                <li>Mọi thông tin người dùng sẽ được bảo mật.</li>
              </ul>
            </div>

            <!-- Các trạng thái dịch vụ -->
            <div class="list-group-item mb-3">
              <p class="text-default-900 text-lg font-bold">CÁC TRẠNG THÁI DỊCH VỤ</p>
              <ul class="font-semibold">
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-primary-600 text-primary-600">Hoàn thành</span>: Hoàn thành đơn hàng.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-sky-600 text-sky-600">Đang chạy</span>: Đơn hàng trong tiến trình chạy.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-red-600 text-red-600">Đang tiến hành</span>: Đơn hàng đang tiến hành xếp đơn.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-sky-600 text-sky-600">Đang xử lý</span>: Đơn hàng đang lên đơn.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-red-600 text-red-600">Đã hủy</span>: Có lỗi trong tiến trình, liên hệ admin kiểm tra.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-yellow-600 text-yellow-600">Chờ xử lý</span>: Đơn hàng đang chờ lên đơn.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-red-600 text-red-600">Đã hoàn tiền</span>: Đơn hàng đã được xác nhận lỗi và hoàn tiền.</li>
              </ul>
            </div>

            <!-- Các trạng thái nạp thẻ cào -->
            <div class="list-group-item mb-3">
              <p class="text-default-600 text-[20px] font-bold">CÁC TRẠNG THÁI NẠP THẺ CÀO</p>
              <ul>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-yellow-600 text-yellow-600">Chờ xử lý</span>: Thẻ cào đã được gửi đi và đang chờ xét thẻ.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-primary-600 text-primary-600">Thành công</span>: Thẻ gửi đúng và được cộng tiền.</li>
                <li><span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-bold border border-red-600 text-red-600">Thất bại</span>: Thẻ gửi sai hoặc đã được sử dụng trước đó.</li>
              </ul>
            </div>

            <!-- Lưu ý về cập nhật điều khoản -->
            <div class="list-group-item mb-3">
              <p style="font-size: 16px;"><span style="color:#e74c3c;" class="text-default-600 text-[20px] font-bold">Lưu ý: Điều khoản này sẽ được thay đổi và cập nhật thường xuyên.</span></p>
            </div>

            <h5 class="text-default-600 text-[30px] font-bold text-center">{{site('name_site')}} Chân Thành Cảm Ơn Đã Sử Dụng Dịch Vụ.</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection