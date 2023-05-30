
function signIn() {
    // Google's OAuth 2.0 endpoint for requesting an access token
    var oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

    // Create <form> element to submit parameters to OAuth 2.0 endpoint.
    var form = document.createElement('form');
    form.setAttribute('method', 'GET'); // Send as a GET request.
    form.setAttribute('action', oauth2Endpoint);

    // Parameters to pass to OAuth 2.0 endpoint.
    var params = {
        'client_id': '166800452308-60m81fpipuq1855q7o45h18k0c1damj8.apps.googleusercontent.com',
        'redirect_uri': 'https://inundated-lenders.000webhostapp.com/login/login.php',
        'response_type': 'token',
        'scope': 'https://www.googleapis.com/auth/userinfo.profile',
        'include_granted_scopes': 'true',
        'state': 'pass-through value'
    };

    // Add form parameters as hidden input values.
    for (var p in params) {
        var input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', p);
        input.setAttribute('value', params[p]);
        form.appendChild(input);
    }

    // Add form to page and submit it to open the OAuth 2.0 endpoint.
    document.body.appendChild(form);
    form.submit();
    sessionStorage.setItem("google_login", "true");

}

if(sessionStorage.getItem("google_login") == "true") {
    getData();
}

function getData() {
    var params = {};
    var regex = /([^&=]+)=([^&]*)/g, m;
    while (m = regex.exec(location.href)) {
        params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    if (Object.keys(params).length > 0) {
        localStorage.setItem('authInfo', JSON.stringify(params));
    }
    // window.history.pushState({}, document.title, "/" + "login.php");
    let info = JSON.parse(localStorage.getItem('authInfo'))
    console.log(info);
    // console.log(info['access_token'])
    // console.log(info['expires_in'])

    fetch("https://www.googleapis.com/oauth2/v3/userinfo", {
        headers: {
            "Authorization": `Bearer ${info['access_token']}`
        }
    })
        .then(data => data.json())
        .then((info) => {
            console.log(info)
            // var token_info = JSON.parse(localStorage.getItem('authInfo'))
            jQuery.ajax({
                url: 'google_redirect.php',
                type: 'POST',
                data: 'name=' + info.name + '&id=' + info.sub + '&email=' + info.email,
                success: function (result) {
                    sessionStorage.setItem("google_login", "false");
                    window.location.href = '../index.php';
                }
            });
            // document.getElementById('name').innerHTML += info.name
            // document.getElementById('image').setAttribute('src',info.picture)
    })
}

function google_logout() {
    fetch("https://oauth2.googleapis.com/revoke?token=" + info['access_token'],
        {
            method: 'POST',
            headers: {
                "Content-type": "application/x-www-form-urlencoded"
            }
        })
        .then((data) => {
            window.location.href = 'login.php';
        })
}