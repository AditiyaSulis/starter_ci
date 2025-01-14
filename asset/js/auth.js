function swalMssg(stat, mssg, text, confirmationButton, timer) {
    return Swal.fire({
        title: mssg,  
        html: text,   
        icon: stat,
        text: mssg,   
        heightAuto: false,  
        showConfirmButton: confirmationButton,  
        timer: timer,  
    });
}

function swallMssg_e(mssg, btnconf, timer){
    return Swal.fire({
        title: 'error',  
        html: mssg,   
        icon: 'error',
        heightAuto: false,  
        showConfirmButton: btnconf,  
        timer: timer,  
    });
}

function swallMssg_s(mssg, btnconf, timer){
    return Swal.fire({
        title: 'success',  
        html: mssg,   
        icon: 'success',
        heightAuto: false,  
        showConfirmButton: btnconf,  
        timer: timer,  
    });
}

$(document).ready(function () {
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();  
        $("#kt_sign_in_submit").prop("disabled", true); 
        $.ajax({
            url: $("#loginForm").data("action"),  
            type: "POST",  
            data: $(this).serialize(),  
            dataType: "json",  
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                        .then(() =>  {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        });
                } else {
                    swallMssg_e(response.message, true, 0);
                }
                $("#kt_sign_in_submit").prop("disabled", false);  
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan :' + error, true, 0)
                $("#kt_sign_in_submit").prop("disabled", false);  
            }
        });
    });
});




