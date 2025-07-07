console.log('%cĐược phát triển bởi: %cNguyễn Hoàng Duy %c- https://zalo.me/0382771060', 'color: #007bff; font-weight: bold; font-size: 20px;', 'color: #007bff; font-weight: bold; font-size: 20px;', 'color: #007bff; font-weight: bold; font-size: 20px;');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function swal(text, icon) {
    if (icon == "success") {
        Swal.fire({
            heightAuto: false,
            icon: icon,
            title: `<h3>Thông báo</h3>`,
            html: `${text}`,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: 'swal2-confirm btn btn-success'  // Thêm class Bootstrap cho nút confirm
            }
        });
    } else {
        Swal.fire({
            heightAuto: false,
            icon: icon,
            title: `<h3>Thông báo</h3>`,
            html: `${text}`,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: 'swal2-confirm btn btn-danger'  // Thêm class Bootstrap cho nút confirm
            }
        });
    }
}

const coppy = (element) => {
    const textArea = document.createElement("textarea");
    textArea.value = element;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("copy");
    document.body.removeChild(textArea);
    swal(`Sao chép thành công`, "success");
}

const toastrNotify = (text, icon) => {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr[icon](text, 'Thông báo!');
}

const copyToClipboard = (element) => {
    const $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element).select();
    document.execCommand("copy");
    $temp.remove();
    swal(`Sao chép thành công `, "success");
}