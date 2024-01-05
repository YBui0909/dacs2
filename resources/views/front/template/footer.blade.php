<div class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row" style="height: 60px; display: flex; align-items: center; justify-content: center">
                <ul class="footer_top-list">
                    <li class="footer_top-item">
                        <div>Đăng kí để nhận tin mới nhất</div>
                    </li>
                    <li class="footer_top-item">
                        <input type="text" id="emailInput" placeholder="Vui lòng nhập email của bạn">
                        <button type="button" onclick="sendEmail()" id="btnSendEmail">Gửi</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer_logo">
                        <a href="/" title="Trang chủ">
                            <img src="/resources/images/logo/{{ $logo->Description }}" alt="Logo"
                                style="width: auto; height: 88px;">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer_copyright">
                        <span>{{ $copyright->Description }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
