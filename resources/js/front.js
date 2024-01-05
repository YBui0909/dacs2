function sendEmail() {
    var email = $('#emailInput').val();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {
        var token = $('#_token').val();
        $.ajax({
            url: 'dang-ki-nhan-tin-moi-nhat',
            type: 'POST',
            data: {
                email: email,
                _token: token
            },
            success: function (data) {
                // Phản hồi thành công từ server
                alert(data);
            },
            error: function (error) {
                // Phản hồi lỗi từ server
                alert('Đăng ký thất bại. Vui lòng thử lại.');
            }
        });
    } else {
        alert('Email không hợp lệ. Vui lòng nhập email đúng định dạng.');
    }
}

function sendMessage() {
    var email = $('#email').val();
    var name = $('#name').val();
    var phone = $('#phone').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {
        var token = $('#_token').val();
        $.ajax({
            url: 'lien-he-hoi-dap',
            type: 'POST',
            data: {
                email: email,
                name: name,
                phone: phone,
                subject: subject,
                message: message,
                _token: token
            },
            success: function (data) {
                // Phản hồi thành công từ server
                alert(data);
            },
            error: function (error) {
                // Phản hồi lỗi từ server
                alert('Gửi tin thất bại. Vui lòng thử lại.');
            }
        });
    } else {
        alert('Email không hợp lệ. Vui lòng nhập email đúng định dạng.');
    }
}



