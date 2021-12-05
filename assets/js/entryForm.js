console.log("test")

function mustBeLetter(inputtxt)
{
    var letters = /^[A-Za-z]+$/;
    if(inputtxt.value.match(letters))
    {
        return true;
    }
    else
    {
        alert("message");
        return false;
    }
}

function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}
function clsAlphaNoOnly2 () {  // Accept only alpha numerics, no special characters
    return clsAlphaNoOnly (this.event); // window.event
}