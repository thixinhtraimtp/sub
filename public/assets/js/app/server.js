document.getElementById('fetchPrice').addEventListener('click', function(event) {
    event.preventDefault();
    const loadingSwal = Swal.fire({
        title: 'Đang đồng bộ dịch vụ...',
        text: 'Vui lòng đợi...',
        icon: 'info',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); 
        }
    });
    $.ajax({
        url: '/api/v1/price/smm',
        type: 'GET',
        success: function(response) {
            loadingSwal.close();
            const message = response.message;
            Swal.fire({
                title: 'Thành công',
                text: message,
                icon: 'success',
                confirmButtonText: 'Xác nhận'
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr, status, error) {
            loadingSwal.close();
            Swal.fire({
                title: 'Lỗi',
                text: 'Không thể lấy dữ liệu từ API. Vui lòng thử lại sau.',
                icon: 'error',
                confirmButtonText: 'Xác nhận'
            }).then(() => {
                location.reload();
            });
        }
    });
});


const apiSelect = document.getElementById('apiSelect');
const categorySelect = document.getElementById('categorySelect');
let allServices = [];
let currentPage = 1;
let itemsPerPage = 20; 

const itemsPerPageSelect = document.getElementById('itemsPerPageSelect');
itemsPerPageSelect.addEventListener('change', function() {
    itemsPerPage = parseInt(itemsPerPageSelect.value);  
    const selectedCategory = categorySelect.value;  
    const filteredServices = selectedCategory ? allServices.filter(service => service.category === selectedCategory) : allServices;
    displayServicesForPage(currentPage, filteredServices);
    
    updatePagination(filteredServices);
});


apiSelect.addEventListener('change', function() {
    const selectedOption = apiSelect.options[apiSelect.selectedIndex];
    const apiUrl = selectedOption.value;
    const apiKey = selectedOption.getAttribute('data-api-key');
    const tigia = selectedOption.getAttribute('data-tigia');
    const url = `/api/v1/get/services?domain=${encodeURIComponent(apiUrl)}&key=${encodeURIComponent(apiKey)}`;

    if (apiUrl) {
        const data = new URLSearchParams();
        data.append('key', apiKey);
        data.append('action', 'services');

        fetch(url, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            allServices = data;
            const tableBody = document.querySelector('#serviceTable tbody');
            tableBody.innerHTML = '';
            // Lấy các category duy nhất và sắp xếp
            const categories = [...new Set(data.map(service => service.category))];
            categories.sort();
            categorySelect.innerHTML = '<option value="">-- Chọn Category --</option>';
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                categorySelect.appendChild(option);
            });

            categorySelect.disabled = false;

            // Hiển thị dịch vụ cho trang hiện tại
            displayServicesForPage(currentPage);

            // Cập nhật phân trang
            updatePagination();
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    } else {
        const tableBody = document.querySelector('#serviceTable tbody');
        tableBody.innerHTML = '';
        categorySelect.innerHTML = '<option value="">-- Chọn Category --</option>';
        categorySelect.disabled = true;
    }
});

// Lọc dịch vụ theo category đã chọn
categorySelect.addEventListener('change', function() {
    const selectedCategory = categorySelect.value;
    const filteredServices = selectedCategory ? allServices.filter(service => service.category === selectedCategory) : allServices;

    // Hiển thị dịch vụ sau khi lọc
    displayServicesForPage(currentPage, filteredServices);
    // Cập nhật phân trang cho danh sách đã lọc
    updatePagination(filteredServices);
});

// Hiển thị dịch vụ cho một trang
function displayServicesForPage(page, services = allServices) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = page * itemsPerPage;
    const servicesToDisplay = services.slice(startIndex, endIndex);
    const tableBody = document.querySelector('#serviceTable tbody');
    tableBody.innerHTML = '';  // Xóa bảng cũ trước khi thêm bảng mới

    servicesToDisplay.forEach(service => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center">
                <input class="form-check-input checkbox" type="checkbox" name="checked_ids[]" value="${service.service}" class="service-checkbox">
            </td>
            <td>${service.service}</td>
            <td>
                <ul>
                    <li>Tên: ${service.name}</li>
                    <li>Danh mục: ${service.category}</li>
                </ul>
            </td>
            <td>
                <ul>
                    <li>
                        <strong class="text-success">Giá: </strong>
                        ${(parseFloat(service.rate) * parseFloat(apiSelect.selectedOptions[0].getAttribute('data-tigia'))  / 1000).toFixed(4)}đ
                    </li>
                    <li>
                        <strong class="text-primary">Min: </strong>
                        ${service.min}
                    </li>
                    <li>
                        <strong class="text-info">Max: </strong>
                        ${service.max}
                    </li>
                </ul>
            </td>
            <td>
                <ul>
                    <li>Loại: ${service.type}</li>
                    <li>REFILL: ${service.refill ? 'Có' : 'Không'}</li>
                </ul>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // Gán sự kiện change cho các checkbox mới thêm vào
    attachCheckboxEvent();
}

// Gán sự kiện change cho các checkbox
function attachCheckboxEvent() {
    $("input[name='checked_ids[]']").on('change', function() {
        updateProviderServer(); // Cập nhật giá trị khi checkbox thay đổi
    });
}

// Cập nhật giá trị của input#providerServer
function updateProviderServer() {
    const checkedIds = [];
    $("input[name='checked_ids[]']:checked").each(function() {
        checkedIds.push($(this).val()); // Thêm giá trị của từng checkbox vào mảng
    });
    $("#providerServer").val(checkedIds.join(" ")); // Cập nhật giá trị vào input#providerServer, cách nhau bằng dấu cách
}

// Cập nhật phân trang
function updatePagination(services = allServices) {
    const totalPages = Math.ceil(services.length / itemsPerPage);
    const paginationControls = document.getElementById('paginationControls');
    paginationControls.innerHTML = '';  // Xóa các nút phân trang cũ

    // Nút "Trang trước"
    if (currentPage > 1) {
        const prevButton = document.createElement('button');
        prevButton.textContent = '«';
        prevButton.onclick = function() {
            currentPage--;
            displayServicesForPage(currentPage, services);
            updatePagination(services);
        };
        paginationControls.appendChild(prevButton);
    }

    const firstPageButton = document.createElement('button');
    firstPageButton.textContent = '1';
    if (currentPage === 1) {
        firstPageButton.disabled = true;  
    }
    firstPageButton.onclick = function() {
        currentPage = 1;
        displayServicesForPage(currentPage, services);
        updatePagination(services);
    };
    paginationControls.appendChild(firstPageButton);

    let startPage = Math.max(2, currentPage - 4);
    let endPage = Math.min(totalPages - 1, currentPage + 4);

    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.textContent = i;
        if (i === currentPage) {
            pageButton.disabled = true;
        }
        pageButton.onclick = function() {
            currentPage = i;
            displayServicesForPage(currentPage, services);
            updatePagination(services);
        };
        paginationControls.appendChild(pageButton);
    }

    if (currentPage < totalPages) {
        const nextButton = document.createElement('button');
        nextButton.textContent = '»';
        nextButton.onclick = function() {
            currentPage++;
            displayServicesForPage(currentPage, services);
            updatePagination(services);
        };
        paginationControls.appendChild(nextButton);
    }
}

$('#createServerV2').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const providerServer = $('#providerServer').val().trim(); 
    const submitButton = $('button[type="submit"]');
    const originalButtonText = submitButton.html();
    if (!providerServer) {
        Swal.fire({
            title: 'Lỗi!',
            text: 'Vui lòng nhập đầy đủ thông tin.',
            icon: 'error',
            confirmButtonText: 'OK',
        });
        return; 
    }

    submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Đang xử lý...');

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function (response) {
            submitButton.prop('disabled', false).html(originalButtonText);

            Swal.fire({
                title: 'Thành công!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Chọn tiếp',
                cancelButtonText: 'Đóng',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#checked_all').prop('checked', false); 
                    $('#providerServer').val('');
                    $('input[name="checked_ids[]"]').prop('checked', false);
                    Swal.close();
                } else {
                    location.reload();
                }
            });
        },
        error: function (xhr) {
            submitButton.prop('disabled', false).html(originalButtonText);

            Swal.fire({
                title: 'Lỗi!',
                text: xhr.responseJSON?.message || 'Đã xảy ra lỗi, vui lòng thử lại!',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
    });
});

