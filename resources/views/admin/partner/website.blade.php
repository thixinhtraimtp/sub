@extends('admin.layouts.app')
@section('title', 'Danh sách Website Con')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">DANH SÁCH WEBSITE CON</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thao tác</th>
                                    <th>Tên Website</th>
                                    <th>Trạng thái</th>
                                    <th>Trạng thái Cloudflare</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partnerWebsites as $partnerWebsite)
                                    <tr>
                                        <td>{{ $partnerWebsite->id }}</td>
                                        <td>
                                            {{--  <a href="{{ route('admin.partner.website.edit', $partnerWebsite->id) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                             --}}
                                            <a href="{{ route('admin.website.partner.delete', $partnerWebsite->id) }}"
                                                class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip"
                                                title="Xóa">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            {{-- kiểm tra trạng thái cloudflare --}}
                                            @if ($partnerWebsite->status !== 'active')
                                                <a href="{{ route('admin.website.partner.active', $partnerWebsite->id) }}"
                                                    class="btn btn-success-gradient btn-sm" data-bs-toggle="tooltip"
                                                    title="Kích hoạt">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.website.partner.deactive', $partnerWebsite->id) }}"
                                                    class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip"
                                                    title="Ngưng kích hoạt">
                                                    <i class="fa fa-times"></i>
                                                </a> --}}
                                            @endif
                                        </td>
                                        <td>{{ $partnerWebsite->name }}</td>
                                        <td>
                                            @if ($partnerWebsite->status == 'active')
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            @elseif($partnerWebsite->status == 'inactive')
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            @else
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partnerWebsite->zone_status == 'active')
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            @elseif($partnerWebsite->zone_status == 'inactive')
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            @else
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>{{ $partnerWebsite->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (getDomain() == env('APP_MAIN_SITE'))
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">DANH SÁCH TẤT CẢ WEBSITE CON/ CHÁU</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table id="data-table-2" class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thao tác</th>
                                    <th>Tên Website</th>
                                    <th>Site Mẹ</th>
                                    <th>Trạng thái</th>
                                    <th>Trạng thái Cloudflare</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allPartnerWebsites as $partnerWebsite)
                                    <tr>
                                        <td>{{ $partnerWebsite->id }}</td>
                                        <td>
                                            {{--  <a href="{{ route('admin.partner.website.edit', $partnerWebsite->id) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                             --}}
                                            <a href="{{ route('admin.website.partner.delete', $partnerWebsite->id) }}"
                                                class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip" title="Xoá">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="{{ route('admin.website.partner.reset', $partnerWebsite->id) }}" class="btn btn-warning-gradient btn-sm" data-bs-toggle="tooltip" title="Duyệt lại">
                                                <i class="fa fa-sync"></i>
                                            </a>
                                            {{-- kiểm tra trạng thái cloudflare --}}
                                            @if ($partnerWebsite->status !== 'active')
                                                <a href="{{ route('admin.website.partner.active', $partnerWebsite->id) }}"
                                                    class="btn btn-success-gradient btn-sm" data-bs-toggle="tooltip" title="Kích hoạt">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                            
                                        </td>
                                        <td>{{ $partnerWebsite->name }}</td>
                                        <td>{{ $partnerWebsite->domain }}</td>
                                        <td>
                                            @if ($partnerWebsite->status == 'active')
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            @elseif($partnerWebsite->status == 'inactive')
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            @else
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partnerWebsite->zone_status == 'active')
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            @elseif($partnerWebsite->zone_status == 'inactive')
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            @else
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>{{ $partnerWebsite->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
@section('script')
<script>
    $('#data-table-2').DataTable();
    $('#jsource-table').DataTable({
        data: dataSet,
    });
</script>
@endsection
