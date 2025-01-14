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

// Add Product
$(document).ready(function () {
    $("#addproduct").on("submit", function (e) {
        e.preventDefault(); 

        var formElement = this; 
        var formData = new FormData(formElement); 

        $("#submit_product").prop("disabled", true); 

        $.ajax({
            url: $(formElement).data("action"), 
            type: "POST", 
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: "json", 
            success: function (response) {
                $("#submit_product").prop("disabled", false); 
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                    swallMssg_e(response.message, true, 0); 
                }
            },
            error: function (xhr, status, error) {
                $("#submit_product").prop("disabled", false); 
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menambah data ' + xhr.response, true, 0).
                then(() =>  {
                    location.reload();
                });
            },
        });
    });

});


// // Delete Product
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-delete-product").on("click", function () {
        var id_product = $(this).data("id_product");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Produk ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "admin/product/delete", 
                    type: "POST",
                    data: { id_product: id_product },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                            .then(() =>  {
                                location.reload();
                            });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr, status, error) {
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product '+error , true, 0).
                        then(() =>  {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});


// UPDATE PRODUCT
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-edit").on("click", function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var description = $(this).data("description");
        var url = $(this).data("url");
        var logo = $(this).data("logo");

        $("#edit_id").val(id);
        $("#edit_name").val(name);
        $("#edit_description").val(description);
        $("#edit_url").val(url);



        $("#editModal").modal("show");
    });


    $("#editProductForm").on("submit", function (e) {
        e.preventDefault();

        var formElement = this; 
        var formData = new FormData(formElement); 

        $.ajax({
            url: base_url +"admin/product/update",
            type: "POST",
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                    swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


// EDIT EMPLOYEE
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');
   

    $("#editEmployeeForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "admin/employee/update", 
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                        swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data '+ error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


//EDIT ACCOUNT CODE
function editAcButton(element)
{
    let $element = $(element);

    $("#id_code").val($element.data('id_code'));
    $("#id_kategori").val($element.data('kategori'));
    $("#code").val($element.data('code'));
    $("#name_code").val($element.data('name_code'));

    $("#editAccountModal").modal("show");
}


$(document).ready(function () 
{
    var base_url = $('meta[name="base_url"]').attr('content');
    console.log($("#id_code").val());

    $("#editAccountForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "admin/account_code/update", 
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                        swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


// DELETE ACCOUNT CODE
$(document).ready(function () 
{
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-delete-ac").on("click", function () {
        var id = $(this).data("id");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Account code ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "admin/account_code/delete", 
                    type: "POST",
                    data: { id_code: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                            .then(() =>  {
                                location.reload();
                            });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr, status, error) {
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product ' + error , true, 0).
                        then(() =>  {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});


//EDIT USER
$(document).ready(function () {
        var base_url = $('meta[name="base_url"]').attr('content');
       
    
        $("#user").on("click", function (event) {
            event.preventDefault(); // Mencegah reload halaman jika href="#"
        
            var $button = $(this); // Simpan referensi elemen yang diklik
            var id = $button.data('id'); // Ambil data-id
    
            console.log(id);
      
                    $.ajax({
                        url: base_url + "auth/edit_get", 
                        type: "POST",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.status) {
                                var id = response.account.id;
                                var name = response.account.name;
                                var email = response.account.email;
                               
    
                                $("#id").val(id);
                                $("#name").val(name);
                                $("#email").val(email);
                                
    
    
    
                                $("#editUser").modal("show");
                            } else {
                                swallMssg_e(response.message, true, 0);
                            }
                        },
                        error: function (xhr, status, error) {
                            swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product '+error , true, 0).
                            then(() =>  {
                                location.reload();
                            });
                        }
                    });
        });

        $("#editUserForm").on("submit", function (e) {
            e.preventDefault();
    
            var formElement = this; 
            var formData = new FormData(formElement); 
    
            $.ajax({
                url: base_url +"auth/update_post",
                type: "POST",
                data: formData,
                contentType: false, 
                processData: false, 
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        swallMssg_s(response.message, false, 1500)
                        .then(() =>  {
                            location.reload();
                        });
                    } else {
                        swallMssg_e(response.message, true, 0);
                    }
                },
                error: function (xhr, status, error) {
                    swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                    then(() =>  {
                        location.reload();
                    }); 
                }
            });
        });

});


// Delete SUPPLIER
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-delete-sp").on("click", function () {
        var id_supplier = $(this).data("id_supplier");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Supplier ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "admin/supplier/delete", 
                    type: "POST",
                    data: { id_supplier: id_supplier },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                            .then(() =>  {
                                location.reload();
                            });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr, status, error) {
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product '+error , true, 0).
                        then(() =>  {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});


// SET STATUS SUPPLIER
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-edit").on("click", function () {
        var id_supplier = $(this).data("id_supplier");
        var name_supplier = $(this).data("name_supplier");
        var contact_info = $(this).data("contact_info");
        var status_supplier = $(this).data("status_supplier");


        $("#id_supplier").val(id_supplier);
        $("#name_supplier").val(name_supplier);
        $("#contact_info").val(contact_info);
        $("#status_supplier").val(status_supplier);



        $("#editSupplierModal").modal("show");
    });


    $("#editSupplierForm").on("submit", function (e) {
        e.preventDefault();

        var formElement = this; 
        var formData = new FormData(formElement); 

        $.ajax({
            url: base_url +"admin/supplier/update",
            type: "POST",
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                    swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-set").on("click", function () {
        var id_supplier = $(this).data("id_supplier");
        var status_supplier = $(this).data("status_supplier");


        $("#id_supplier_status").val(id_supplier);
        $("#setstatussupplier").val(status_supplier);



        $("#setStatusModal").modal("show");
    });


    $("#setStatusForm").on("submit", function (e) {
        e.preventDefault();

        var formElement = this; 
        var formData = new FormData(formElement); 

        $.ajax({
            url: base_url +"admin/supplier/set_status",
            type: "POST",
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                    swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


// Delete Product
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-delete-pc").on("click", function () {
        var id = $(this).data("id_purchases");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Transaksi ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "admin/purchases/delete", 
                    type: "POST",
                    data: { id_purchases: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                            .then(() =>  {
                                location.reload();
                            });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr, status, error) {
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product '+error , true, 0).
                        then(() =>  {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});


// SET VISIBILITY PRODUCT
$(document).ready(function () {
    var base_url = $('meta[name="base_url"]').attr('content');

    $(".btn-visibility").on("click", function () {
        var id_product = $(this).data("id_product");
        var visibility = $(this).data("visibility");


        $("#id_product_visibility").val(id_product);
        $("#visibility").val(visibility);



        $("#setVisibilityModal").modal("show");
    });


    $("#setVisibilityForm").on("submit", function (e) {
        e.preventDefault();

        var formElement = this; 
        var formData = new FormData(formElement); 

        $.ajax({
            url: base_url +"admin/product/set_visibility",
            type: "POST",
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    swallMssg_s(response.message, false, 1500)
                    .then(() =>  {
                        location.reload();
                    });
                } else {
                    swallMssg_e(response.message, true, 0);
                }
            },
            error: function (xhr, status, error) {
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});




