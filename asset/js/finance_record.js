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
                swallMssg_e('Terjadi kesalahan: Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menambah data ' + xhr.response, true, 0).
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

    $(".btn-delete").on("click", function () {
        var id = $(this).data("id");

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
                    data: { id_product: id },
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
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product' , true, 0).
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
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data', true, 0).
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
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data'+ xhr.response + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


// DELETE EMPLOYEE
// $(document).ready(function () {
//     var base_url = $('meta[name="base_url"]').attr('content');

//     $(".btn-delete-emp").on("click", function () {
//         var id = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda yakin?",
//             text: "Data karyawan ini akan dihapus secara permanen!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#d33",
//             cancelButtonColor: "#3085d6",
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Batal"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: base_url + "admin/employee/delete", 
//                     type: "POST",
//                     data: { id_employee: id },
//                     dataType: "json",
//                     success: function (response) {
//                         if (response.status) {
//                             swallMssg_s(response.message, false, 1500)
//                             .then(() =>  {
//                                 location.reload();
//                             });
//                         } else {
//                             swallMssg_e(response.message, true, 0);
//                         }
//                     },
//                     error: function (xhr, status, error) {
//                         swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product' , true, 0).
//                         then(() =>  {
//                             location.reload();
//                         });
//                     }
//                 });
//             }
//         });
//     });
// });



// EDIT FINANCE RECORD
// $(document).ready(function () {
//     const base_url = $('meta[name="base_url"]').attr('content');
    


//     $(".btn-edit-finrec").on("click", function () {
//         const data = $(this).data();
//         console.log("Kategori:", data.kategori); 
        
//         $("#id_record").val(data.id);
//         $("#kategori").val(data.kategori).trigger("change");
//         $("#product_id").val(data.product);
//         $("#amount").val(data.amount);
//         $("#description").val(data.description);

//         $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
//         if (data.kategori) {
//             accID   = 'id_code';
//             accVAL  = data.id_code;
//             getAccount(data.kategori);
//         }

//         $("#editfinanceModal").modal("show");
//     });

//     $("#kategori").on("change", function () {
//         const categoryId = $(this).val();
//         $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
//         if (categoryId) {
//             getAccount(categoryId);
//         }
//     });


//     $("#editfinanceForm").on("submit", function (e) {
//         e.preventDefault();
//         console.log('test')
//         $.ajax({
//             url: base_url + "admin/finance_record/update",
//             type: "POST",
//             data: $(this).serialize(),
//             dataType: "json",
//             success: function (response) {
//                 if (response.status) {
//                     Swal.fire({
//                         icon: "success",
//                         title: "Berhasil",
//                         text: response.message,
//                         timer: 1500,
//                         showConfirmButton: false
//                     }).then(() => location.reload());
//                 } else {
//                     Swal.fire({
//                         icon: "error",
//                         title: "Gagal",
//                         text: response.message
//                     });
//                 }
//             },
//             error: function (xhr, status, error) {
//                 Swal.fire({
//                     icon: "error",
//                     title: "Error",
//                     text: "Terjadi kesalahan, silahkan coba lagi."
//                 });
//             }
//         });
//     });
// });


// DELETE FINANCE RECORDS
// $(document).ready(function () {
//     var base_url = $('meta[name="base_url"]').attr('content');

//     $(".btn-delete-finrec").on("click", function () {
//         var id = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda yakin?",
//             text: "Record ini akan dihapus secara permanen!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#d33",
//             cancelButtonColor: "#3085d6",
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Batal"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: base_url + "admin/finance_record/delete", 
//                     type: "POST",
//                     data: { id_record: id },
//                     dataType: "json",
//                     success: function (response) {
//                         if (response.status) {
//                             swallMssg_s(response.message, false, 1500)
//                             .then(() =>  {
//                                 location.reload();
//                             });
//                         } else {
//                             swallMssg_e(response.message, true, 0);
//                         }
//                     },
//                     error: function (xhr, status, error) {
//                         swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product' , true, 0).
//                         then(() =>  {
//                             location.reload();
//                         });
//                     }
//                 });
//             }
//         });
//     });
// });

//EDIT ACCOUNT CODE

function editAcButton(element){
    let $element = $(element);

    $("#id_code").val($element.data('id_code'));
    $("#id_kategori").val($element.data('kategori'));
    $("#code").val($element.data('code'));
    $("#name_code").val($element.data('name_code'));

    $("#editAccountModal").modal("show");
}
$(document).ready(function () {
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
                swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data'+ xhr.response + error, true, 0).
                then(() =>  {
                    location.reload();
                }); 
            }
        });
    });
});


// DELETE ACCOUNT CODE


$(document).ready(function () {
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
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product' , true, 0).
                        then(() =>  {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});


