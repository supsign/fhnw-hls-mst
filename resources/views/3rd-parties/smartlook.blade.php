<script type='text/javascript'>
    const COOKIE_VALUE = 1;

    @if($user)
    let useApiForms = '{{$user->id}}'
    @endif


        window.smartlook || (function (d) {
        var o = smartlook = function () {
            o.api.push(arguments)
        }, h = d.getElementsByTagName('head')[0];
        var c = d.createElement('script');
        o.api = [];
        c.async = true;
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.src = 'https://rec.smartlook.com/recorder.js';
        h.appendChild(c);
    })(document);
    smartlook('init', '11f5a67f53d05f46910f256f90ee885a58faf8f4');
    @if($user)
    smartlook('identify', '{{$user->id ?? ""}}', {
        "name": "{{$user->lastname ?? ""}}, {{$user->firstname ?? ""}}",
        "email": "{{$user->email ?? ""}}"
    });

    var smartlook_api_form_consent = "true";
    var smartlook_ip_consent = "true";

    var consentText = 'Smartlook Recording Allowed';
    var clientDecision = true;

    smartlook('consentForms', clientDecision ? consentText : false);
    smartlook('consentAPI', clientDecision ? consentText : false);
    smartlook('consentIP', clientDecision ? consentText : false);
    @endif
</script>