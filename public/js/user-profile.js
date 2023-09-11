//     profile page starts here
// for display select profile picture before saving to database
function profilePictureLoad(input) {
    $("#show-uploaded-picture").addClass("d-block").removeClass("d-none");
    var image1 = document.getElementById("picture");
    if (image1.files && image1.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#show-uploaded-picture').attr('src', e.target.result).width(300).height(200);
        };
        reader.readAsDataURL(image1.files[0]);
    }
}

//            reset the password and upload field when modal is closed
function closeModal() {
    $("#show-uploaded-picture").addClass("d-none").removeClass("d-block");
    $("#profile-picture-alert").addClass("d-none").removeClass("d-block");
    $("#picture").removeClass("input-error");
    $('#changePassword')[0].reset();
    $("#picture").val('');
}

$(document).ready(function () {
    // get all subscriptions
    getSubscriptions();
    function getSubscriptions() {
        var token = $('#my-token').val();
        $.ajax({
            url: "http://127.0.0.1:8000/getAllSubscription",
            method: "get",
            dataType: 'json',
            success: function (response) {
                $('.subscription-container').html("");
                if ($.trim(response.data) == 0) {
                    $('.subscription-container').css('justify-content', 'center');
                    $('.subscription-container').append('<div class="text-center p-4 read-post-comment-preloader"><h3>You have no subscription</h3></div>');
                } else {
                    $('.subscription-container').css('justify-content', 'left');
                    $.each(response.data, function (key, value) {
                        $('.subscription-container').append('\n\
                                        <div class="subcribe-box col-xl-4 col-lg-4 col-md-4 col-6 " style="margin-bottom: 15px;">\
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">\
                                    <div class="image-container">\
                                        <img src="../images/'+ value.subscription_picture +'" alt="" width="100%" height="100%" style="border-radius: 5px;"/>\
                                    </div>\
                                    <div class="" style="text-align: left; margin-bottom: 25px;">\
                                        <h5><strong>' + value.subscription_name + '</strong></h5>\
                                    </div>\
                                    <div class="" style="text-align: left;">\
                                        <button value="' + value.subscription_name + '" class="form-control btn btn-danger unsubscribe-btn"><i class="fas fa-circle-minus"></i> Unsubscribe</button>\
                                    </div>\
                                </div>\
                            </div> \ ');
                    });
                }
                if (response.get_sub.news == 1) {
                    $('#modal-news-btn').html("");
                    $('#modal-news-btn').removeClass("btn-success").addClass("btn-danger");
                    $('#modal-news-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    $('#modal-news-btn').html("");
                    $('#modal-news-btn').removeClass("btn-danger").addClass("btn-success");
                    $('#modal-news-btn').append('<i class="fas fa-circle-plus"></i> Signup');

                }
                if (response.get_sub.business == 1) {
                    $('#modal-business-btn').html("");
                    $('#modal-business-btn').removeClass("btn-success").addClass("btn-danger");
                    $('#modal-business-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    $('#modal-business-btn').html("");
                    $('#modal-business-btn').removeClass("btn-danger").addClass("btn-success");
                    $('#modal-business-btn').append('<i class="fas fa-circle-plus"></i> Signup');
                }
                if (response.get_sub.entertainment == 1) {
                    $('#modal-entertainment-btn').html("");
                    $('#modal-entertainment-btn').removeClass("btn-success").addClass("btn-danger");
                    $('#modal-entertainment-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    $('#modal-entertainment-btn').html("");
                    $('#modal-entertainment-btn').removeClass("btn-danger").addClass("btn-success");
                    $('#modal-entertainment-btn').append('<i class="fas fa-circle-plus"></i> Signup');
                }
                if (response.get_sub.sport == 1) {
                    $('#modal-sport-btn').html("");
                    $('#modal-sport-btn').removeClass("btn-success").addClass("btn-danger");
                    $('#modal-sport-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    $('#modal-sport-btn').html("");
                    $('#modal-sport-btn').removeClass("btn-danger").addClass("btn-success");
                    $('#modal-sport-btn').append('<i class="fas fa-circle-plus"></i> Signup');

                }
                if (response.get_sub.technology == 1) {
                    $('#modal-technology-btn').html("");
                    $('#modal-technology-btn').removeClass("btn-success").addClass("btn-danger");
                    $('#modal-technology-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    $('#modal-technology-btn').html("");
                    $('#modal-technology-btn').removeClass("btn-danger").addClass("btn-success");
                    $('#modal-technology-btn').append('<i class="fas fa-circle-plus"></i> Signup');

                }
            }
        });
    }
    
      // code to unsubscribe from a category excluding the subscription modal
    $(document).on('click', '.unsubscribe-btn', function (e) {
        e.preventDefault();
        var thisClick = $(this);
        thisClick.closest('.subcribe-box').find('.unsubscribe-btn').html("");
        thisClick.closest('.subcribe-box').css('opacity', '50%');
        thisClick.closest('.subcribe-box').find('.unsubscribe-btn').append('<i class="fa fa-spinner fa-spin"></i>');
        var subscription_name = thisClick.val();
        var _token = $('#my-token').val();
        var data = {
            'subscription_name': subscription_name,
            'unsubscribe': 'unsubscribe',
            '_token': _token
        };
        $.ajax({
            url: "http://127.0.0.1:8000/subcribeUnsubcribe",
            method: "post",
            data: data,
            dataType: 'json',
            success: function (response) {
                getSubscriptions();
                $('#profile-activities-table').DataTable().destroy();
                fetch_data();          
            },
            error: function (data) {
            }
        });
    });

  
    // to add or remove subscription in the subscription modal
    $(document).on('click', '.sub-unsub-btn', function (e) {
        e.preventDefault();
        var thisClick = $(this);
        thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').html("");
        thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').append('<i class="fa fa-spinner fa-spin"></i>');
        thisClick.closest('.class').css('opacity', '50%');
        var subscription_name = thisClick.val();
        var subscription_picture = subscription_name + '.jpg';
        var _token = $('#my-token').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = {
            'subscription_name': subscription_name,
            'subscription_picture' : subscription_picture,
            'unsubscribe': '',
            '_token': _token
        };
        $.ajax({
            url: "http://127.0.0.1:8000/subcribeUnsubcribe",
            method: "post",
            data: data,
            dataType: 'json',
            success: function (response) {
                thisClick.closest('.class').css('opacity', '100%');
                getSubscriptions();
                $('#profile-activities-table').DataTable().destroy();
                fetch_data();
                thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').html("");
                if (response.data == 1) {
                    thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').removeClass("btn-success").addClass("btn-danger");
                    thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').append('<i class="fas fa-circle-minus"></i> Unsubscribe');
                } else {
                    thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').removeClass("btn-danger").addClass("btn-success");
                    thisClick.closest('.modal-sub-container').find('.sub-unsub-btn').append('<i class="fas fa-circle-plus"></i> Signup');
                }
            },
            error: function (data) {

            }
        });
    });

    // gets the subscriptions for the add newsletter modal
    $(document).on('click', '.get-add-newsletter', function (e) {
        getSubscriptions();
    });

    // bring the drop-down calender when a date field is clicked
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    // draws the data for the activity table for profile page
    fetch_data();
    function fetch_data(start_date = '', end_date = '')
    {
        $('#profile-activities-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
                "sEmptyTable": "No activity found"
            },
            order: [],
            "error": "this is test",
            ajax: {
                url: "http://127.0.0.1:8000/profile",
                method: "GET",
                data: {start_date: start_date, end_date: end_date}
            },
            columns: [
                {
                    data: 'description'
                }
                ,
                {
                    data: 'created_at'
                }
            ]
        });
    }


    // handles the filter button for searching the activity page
    $('#filter').click(function () {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if (start_date != '' && end_date != '')
        {
            $('#profile-activities-table').DataTable().destroy();
            fetch_data(start_date, end_date);
        } else
        {
            $('#requireDate').modal('show');
        }
    });

    // refresh the activity table when the refresh button is clicked
    $('#refresh').click(function () {
        $('#start_date').val('');
        $('#end_date').val('');
        $('#profile-activities-table').DataTable().destroy();
        fetch_data();
    });
    $.fn.dataTable.ext.errMode = 'throw';

    // Upload photo code goes here
    $('#upload-photo').submit(function (e) {
        e.preventDefault();
        $('#upload-photo-btn').html("");
        $('#upload-photo-btn').append('<i class="fa fa-spinner fa-spin"></i>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(this);
        $.ajax({
            url: "http://127.0.0.1:8000/userPhoto",
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#profile-activities-table').DataTable().destroy();
                fetch_data();
                if (response) {
                    $('#upload-photo-btn').html("");
                    $('#upload-photo-btn').append('Upload Photo');
                    $("#show-uploaded-picture").addClass("d-none").removeClass("d-block");
                    $("#picture").val('');
                    $("#profile-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#picture").removeClass("input-error");
                    setTimeout(() => {
                        document.getElementById("user-picture").src = "../images/" + response.data;
                        document.getElementById("small-profile-picture").src = "../images/" + response.data;
                        document.getElementById("upload-photo-success-alert").style.display = "block";
                        $('#upload-photo')[0].reset();
                    }, 1000);
                    setTimeout(() => {
                        $('#userPhoto').modal('hide');
                        document.getElementById("upload-photo-success-alert").style.display = "none";
                        $("#uploadPhoto-btn").val("Upload Photo");
                    }, 3000);
                }
            },
            error: function (data) {
                $('#upload-photo-btn').html("");
                $('#upload-photo-btn').append('Upload Photo');
                if ($.trim(data.responseJSON.errors.picture) == 0) {
                    $("#profile-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#picture").removeClass("input-error");
                } else {
                    $("#profile-picture-alert").addClass("d-block").removeClass("d-none");
                    $("#picture").addClass("input-error");
                    document.getElementById("profile-picture-alert").innerHTML = data.responseJSON.errors.picture[0];
                }
            }
        });

    });

    // change password code goes here
    $('#change-password').submit(function (e) {
        e.preventDefault();
        $('#change-password-btn').html("");
        $('#change-password-btn').append('<i class="fa fa-spinner fa-spin"></i>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(this);
        $.ajax({
            url: "http://127.0.0.1:8000/userChangePassword",
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#profile-activities-table').DataTable().destroy();
                fetch_data();
                if (response) {
                    $('#change-password-btn').html("");
                    $('#change-password-btn').append('Change Password');
                    $("#change-password-alert").addClass("d-none").removeClass("d-block");
                    $("#password").removeClass("input-error");
                    setTimeout(() => {
                        $('#change-password')[0].reset();
                        document.getElementById("password-success-alert").style.display = "block";
                    }, 1000);
                    setTimeout(() => {
                        $('#passwordChange').modal('hide');
                        document.getElementById("password-success-alert").style.display = "none";
                        $("#changePassword-btn").val("Change Password");
                    }, 3000);
                }
            },
            error: function (data) {
                $('#change-password-btn').html("");
                $('#change-password-btn').append('Change Password');
                if ($.trim(data.responseJSON.errors.password) == 0) {
                    $("#change-password-alert").addClass("d-none").removeClass("d-block");
                    $("#password").removeClass("input-error");
                } else {
                    $("#change-password-alert").addClass("d-block").removeClass("d-none");
                    $("#password").addClass("input-error");
                    document.getElementById("change-password-alert").innerHTML = data.responseJSON.errors.password[0];
                }
            }
        });

    });
});
// -- profile page ends here --