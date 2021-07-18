<footer class="page-footer">
    <div class="container">

        <div class="client-platforms">
            <a class="cs-btn cs-btn--primary cs-btn--ios" style="display: none">
                <img src="{{ asset('assets/static/mobile/images/index/apple-store-graphics.png') }}" alt="apple download">
            </a>
            <a class="cs-btn cs-btn--primary cs-btn--android" style="display: none">
                <img src="{{ asset('assets/static/mobile/images/index/playe-store-graphics.png') }}" alt="android download">
            </a>
        </div>

        <div class="page-footer__col page-footer__col--shortcut">
            <h4 class="col-title">{{ __('static.mbl_section_footer_title_1') }}</h4>
            <ul class="footer-menu">
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">VPN Setup Tutorial</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Term of use</a></li>
                <li><a href="#">About us</a></li>
            </ul>
        </div>
        <div class="page-footer__col page-footer__col--lang">
            <h4 class="col-title">{{ __('static.mbl_section_footer_title_2') }}</h4>
            <div class="select-wrapper">
                <select class="js-footer-lang">
                    <option value="en" data-value="en" {{  app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    <option value="ch" data-value="ch" {{  app()->getLocale() === 'zh-CN' ? 'selected' : '' }}>中文</option>
                </select>
            </div>
        </div>
        <div class="page-footer__col">
            <h4 class="col-title">{{ __('static.mbl_section_footer_title_3') }}</h4>
            <ul class="social-list">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>
</footer>

</div> <!-- ./end wrappers -->

<?php /* show modal when login successfully */ ?>
@if(Session::has('successLogin'))
<div class="modal fade has-login" id="loginSuccessModal" tabindex="-1" role="dialog" aria-labelledby="signinModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">

                <div class="text-bg">
                    <div class="icon-wrapper" style="text-align: center; margin-bottom: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="64" height="64"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" fill="#3cfa52"/></svg>
                    </div>
                    <h4 style="text-align: center; color: #000; margin-bottom: 30px;">You logged!</h4>
                    <button class="cs-btn cs-btn--primary" type="button" data-dismiss="modal" aria-label="Close">Ok</button>
                </div>

            </div>
        </div>
    </div>
</div>
@endif

@yield("footer-script")

<script>
    $(function() {
        $('.js-footer-lang').on('change', function(e) {
            let value = e.target.value;
            if (value === 'en') {
                window.location.replace(window.location.origin + '/' + 'lang/en');
            } else {
                window.location.replace(window.location.origin + '/' + 'lang/zh-CN');
            }
        });
        function getMobileOperatingSystem() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            if (/android/i.test(userAgent)) {
                return "Android";
            }
            // iOS detection from: http://stackoverflow.com/a/9039885/177710
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "iOS";
            }
            return "unknown";
        }
        let mobileOperation = getMobileOperatingSystem();
        if (mobileOperation === "Android") {
            $(".cs-btn--android").show();
        } else if (mobileOperation === "iOS") {
            $(".cs-btn--ios").show();
        } else {
            $(".cs-btn--ios").show();
            $(".cs-btn--android").show();
        }
        
         if ($("#loginSuccessModal").hasClass("has-login")) {
            $("#loginSuccessModal").modal('show');
        }
    });
</script>

</body>

</html>