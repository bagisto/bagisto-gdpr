   
    @include('gdpr::cookie.dialogContents')

    @push('scripts')
    <script>

        const COOKIE_VALUE = 1;
        const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

        window.onload = function() {
            if(cookieExists())
            {
                hideCookieDialog();
            }
        };

    function createCookie(){
        
        if (cookieExists()) {

            hideCookieDialog()
        }else{
                consentWithCookies();
            }
    }

    function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/{{ config('session.secure') ? ';secure' : null }}'
                    + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
    }

    function consentWithCookies() {
                setCookie('cookie-consent', COOKIE_VALUE, 365 * 20);
                hideCookieDialog();
    }

    function cookieExists() {
                var name = 'cookie-consent';
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
    }

    function hideCookieDialog() {
        const dialogs = document.getElementsByClassName('js-cookie-consent');

        for (let i = 0; i < dialogs.length; ++i) {
            dialogs[i].style.display = 'none';
        }
    }

    </script>

@endpush


