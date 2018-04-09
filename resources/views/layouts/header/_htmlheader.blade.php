<head>
    <meta charset="utf-8"/>
    <title>@yield('page-title', 'Kabooodle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="user_hash" content="{{ $_auth_token }}">
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{staticAsset('/favicon.ico')}}" />
    <link rel="icon" type="image/x-icon" href="{{staticAsset('/favicon.ico')}}" />
    @stack('facebook-tags')

    @push('header-styles')
    <link rel="stylesheet" href="{{ staticAsset('/assets/css/vendor.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ staticAsset('/assets/css/app.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ staticAsset('/assets/css/merchant.css') }}" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Kreon:400,700" rel="stylesheet">
    @endpush

    <script src="//d2wy8f7a9ursnm.cloudfront.net/v4/bugsnag.min.js"></script>
    <script>window.bugsnagClient = bugsnag('b9ae611977c11c0d7ee256bdbbd276f3')</script>
    @if(!webUser())
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.min.js" integrity="sha256-68s1Vjqw1KVP2DiR5uNilZQjf+tF6IrQI9PjKTY88nM=" crossorigin="anonymous"></script>
    @endif
    <script>
        var KABOOODLE_APP = window.KABOOODLE_APP || {};
        KABOOODLE_APP.env = '{{ env('APP_ENV') }}';
        KABOOODLE_APP.currentUser = {!! $_current_user !!};
        KABOOODLE_APP.makeStaticAsset = function (url) {
            var staticAsset = '{{ staticAsset('[URL]') }}';
            return staticAsset.replace('[URL]', url);
        };
    </script>
    <script src="{{ staticAsset('/assets/js/aws-sdk-2.32.0.min.js') }}"></script>
    <script>
        AWS.config.update({
            region: '{{ env('AWS_REGION') }}',
            credentials: new AWS.Credentials({
                accessKeyId: '{{ env('AWS_CLIENT_KEY') }}',
                secretAccessKey: '{{ env('AWS_CLIENT_SECRET') }}'})
        });
        let S3 = new AWS.S3({apiVersion: '2006-03-01'});
    </script>
    <script src="https://js.pusher.com/3.2/pusher.min.js"></script>
    <script>
        try {
            KABOOODLE_APP.pusher = new Pusher('{{ env('PUSHER_KEY') }}', {
                cluster: 'us2',
                authEndpoint: '{{ route('webhooks.pusher') }}',
                auth: {
                    headers: {
                        'X-CSRF-Token': document.querySelectorAll('meta[name="token"]')[0].getAttribute('content')
                    }
                }
            });

            {{--@if(env('APP_ENV') <> 'production')--}}
                Pusher.log = function (message) {
                    if (window.console && window.console.log) {
                        window.console.log(message);
                    }
                };
            {{--@endif--}}
        } catch(e) {
            Bugsnag.notifyException(e);
        }
    </script>
    @push('header-scripts')
    <script src="{{ staticAsset('/assets/js/vendor.js') }}"></script>
    <script type="text/javascript">
        Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="token"]').attr('content');
        @if(!webUser())
            Vue.http.headers.common['X-TZ'] = jstz.determine().name();
        @endif
        @if(webUser())
        Vue.http.headers.common['Authorization'] = "Bearer " + $('meta[name=user_hash]').attr("content");
        @endif
        $(function () {
            @if(webUser())
            moment.tz('{{ webUser()->timezone}}').format();
            $.ajaxPrefilter(function (options, originalOptions, xhr) {
                if (options.url.toLowerCase().indexOf("amazonaws") <= 0) {
                    xhr.setRequestHeader("Authorization", "Bearer " + $('meta[name=user_hash]').attr("content") + "");
                }
            });
            @endif
            var ajaxHeaders = {
                '_token': $('meta[name="token"]').attr('content'),
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            };
            @if(!webUser())
            ajaxHeaders['X-TZ'] = jstz.determine().name();
            @endif
            $.ajaxSetup({
                async: true,
                headers: ajaxHeaders
            });
        });
    </script>
    @endpush

    @stack('header-styles')

    @stack('header-scripts')
</head>