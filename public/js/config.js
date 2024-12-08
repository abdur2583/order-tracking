function showLoader() {
    document.getElementById('loader').classList.remove('d-none')
}
function hideLoader() {
    document.getElementById('loader').classList.add('d-none')
}

function successToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "green",
        }
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "red",
        }
    }).showToast();
}
function unauthorized(code){
    if(code == 401){
        localStorage.clear();
        sessionStorage.clear();
        window.location.href = '/logout';
    }
}
function setToken(token) {
     /*   const date = new Date();
       date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
       expires = "; expires=" + date.toUTCString(); */
       document.cookie='access_token=' + token ;
}
function getToken() {
    const  cookies  = document.cookie ;
    const cookieArray = cookies.split('; ');
    for (let i = 0; i < cookieArray.length; i++) {
        // Split each key=value pair to separate the key from the value
        const cookiePair = cookieArray[i].split('=');
       
        // Check if the current cookie's key matches the one we're looking for
        if (cookiePair[0] === "access_token") {
            // Return the value (token)
            const token = "Bearer " + cookiePair[1];
            //console.log(token);
            return token;
        }
    }
    
    //return localStorage.getItem('token');

}

function headerToken() {
    let token = getToken();
    return {headers:  {
        'Authorization': token
    }
}
}

function headerTokenWithFromData() {
    let token = getToken();
    return {headers:  {
        'Authorization': token,
        'Content-Type': 'multipart/form-data'
    }
}
}
function logout() {
    localStorage.clear();
    sessionStorage.clear();
    window.location.href = '/logout';
}

function select2Option() {
   return { 
    placeholder: "Select Batch No",
    allowClear: true,
    moltiple: false,
    width: '100%',
    theme: "classic",
    }
}