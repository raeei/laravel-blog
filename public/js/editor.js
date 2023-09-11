$(document).ready(function () {
                // code for display the summary of post on the summery box
            
            // code for displaying data on the post table
            $('.input-daterange').datepicker({
            todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
            });
            fetch_data();
            function fetch_data(start_date = '', end_date = '', select_post_type = '', search = '')
            {
            $('#editor-post').DataTable({
            processing: true,
                    serverSide: true,
                    ordering: true,
                    pageLength: 10,
                    oLanguage: {
                    "sEmptyTable": "No post found"
                    },
                    order: [],
                    "error": "this is test",
                    ajax: {
                    url: "{{ route('editor.dashboard') }}",
                            method: "GET",
                            data: {start_date: start_date, end_date: end_date, select_post_type: select_post_type, search: search }
                    },
                    columns: [
                    {
                    data: 'featured_picture',
                            render: function (data) {
                            return '<img src="../images/' + data + '" style="height: 50px; width: 80px;">'
                            }
                    },
                    {
                    data: 'post_title',
                            render: function (data) {
                            if (data.length > 19) {
                            data = data.substr(0, 20) + "...";
                            }
                            return data;
                            }
                    }
                    ,
                    {
                    data: 'body',
                            render: function (data) {
                            if (data.length > 49) {
                            data = data.substr(0, 50) + "...";
                            }
                            return data;
                            }
                    }
                    ,
                    {
                    data: 'category'
                    }
                    ,
                    {
                    data: 'status'
                    }
                    ,
                    {
                    data: 'created_at'
                    }
                    ,
                    {
                    data: 'edit',
                            orderable: false,
                            searchable: false
                    }
                    ,
                    {
                    data: 'view',
                            orderable: false,
                            searchable: false
                    }
                    ]
            });
            }

            // Create post code goes here
            $('#createPostForm').submit(function (e) {
            e.preventDefault();
            $("#createPost").val("please wait...");
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let formData = new FormData(this);
            $.ajax({
            url: "{{ route('editor.storePost') }}",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                    if (response) {
                    setTimeout(() => {
                    $('#createPostForm')[0].reset();
                    $("#post_body").summernote("reset");
                    document.getElementById("success-alert").style.display = "block";
                    document.getElementById("all-post").innerHTML = response.data.all_post;
                    document.getElementById("all-active").innerHTML = response.data.approved_post;
                    document.getElementById("all-pending").innerHTML = response.data.pending_post;
                    document.getElementById("all-cancelled").innerHTML = response.data.cancelled_post;
                    document.getElementById("all-edit").innerHTML = response.data.edit_post;
                    document.getElementById("all-likes").innerHTML = response.data.likes;
                    }, 1000);
                    setTimeout(() => {
                    $('#editorCreatePostModal').modal('hide');
                    document.getElementById("success-alert").style.display = "none"; $('#createPostBtn').val('Create Post');
                    $('#editor-post').DataTable().destroy();
                    fetch_data();
                    }, 3000);
                    }

                    },
                    error: function (data) {
                    // for post title field
                    if ($.trim(data.responseJSON.errors.post_title) == 0) {
                    $("#post-title-alert").addClass("d-none").removeClass("d-block");
                    $("#post_title").removeClass("input-error");
                    } else {
                    $("#post-title-alert").addClass("d-block").removeClass("d-none");
                    $("#post_title").addClass("input-error");
                    document.getElementById("post-title-alert").innerHTML = data.responseJSON.errors.post_title[0];
                    }

                    // for feature picture field
                    if ($.trim(data.responseJSON.errors.feature_picture) == 0) {
                    $("#feature-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#feature_picture").removeClass("input-error");
                    } else {
                    $("#feature-picture-alert").addClass("d-block").removeClass("d-none");
                    $("#feature_picture").addClass("input-error");
                    document.getElementById("feature-picture-alert").innerHTML = data.responseJSON.errors.feature_picture[0];
                    }

                    // for post body field
                    if ($.trim(data.responseJSON.errors.post_body) == 0) {
                    $("#post-body-alert").addClass("d-none").removeClass("d-block");
                    $("#post_body").removeClass("input-error");
                    } else {
                    $("#post-body-alert").addClass("d-block").removeClass("d-none");
                    $("#post_body").addClass("input-error");
                    document.getElementById("post-body-alert").innerHTML = data.responseJSON.errors.post_body[0];
                    }

                    if ($.trim(data.responseJSON.errors.phone) == 0) {
                    $("#phone-alert").addClass("d-none").removeClass("d-block");
                    } else {
                    $("#phone-alert").addClass("d-block").removeClass("d-none");
                    $("#first_name").removeClass("input-error");
                    document.getElementById("phone-alert").innerHTML = data.responseJSON.errors.phone[0];
                    }
                    $('#createPost').val('Create Post');
                    }
            });
            });
            // code for getting of a particular post for editing
            $(document).on('click', '#edit', function () {
            $.ajax({
            url: "{{ route('editor.getPostById') }}",
                    method: "post",
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                            "id": $(this).data('id')
                    },
                    success: function (response) {
                    document.getElementById('dislay_feautred_picture').src = "#";
                    document.getElementById("post_id").value = response.data.id;
                    document.getElementById("edit_category").value = response.data.category;
                    document.getElementById('dislay_feautred_picture').src = "../images/" + response.data.featured_picture;
                    if (response){
                    $('#edit_post_body').summernote('code', response.data.body);
                    $('#edit_post_title').val(response.data.post_title);
                    $('#edit_feature_picture').val('response.data.featured_picture');
                    }
                    }
            });
            });
            // view post code goes here
            $(document).on('click', '#view', function () {
            $.ajax({
            url: "{{ route('editor.viewPost') }}",
                    method: "post",
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                            "id": $(this).data('id')
                    },
                    success: function (response) {
                    document.getElementById("view-post-title").innerHTML = response.data.post_title;
                    document.getElementById("view-featured-picture").src = "../images/" + response.data.featured_picture;
                    document.getElementById("view-post-content").innerHTML = response.data.body;
                    document.getElementById("fa-heart").innerHTML = ' ' + response.count_likes;
                    document.getElementById("fa-comment").innerHTML = ' ' + response.count_comment;
                    document.getElementById("fa-save").innerHTML = ' ' + response.count_favorites;
                    }
            });
            });
            // code for submitting an edited post
            $('#editPostForm').submit(function (e) {
            e.preventDefault();
            $("#editPostBtn").val("please wait...");
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let formData = new FormData(this);
            $.ajax({
            url: "{{ route('editor.editPost') }}",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                    if (response) {
                    setTimeout(() => {
                    $('#editPostForm')[0].reset();
                    $("#edit_post_body").summernote("reset");
                    document.getElementById('dislay_feautred_picture').src = "#";
                    document.getElementById("edit-success-alert").style.display = "block";
                    document.getElementById("all-post").innerHTML = response.data.all_post;
                    document.getElementById("all-active").innerHTML = response.data.approved_post;
                    document.getElementById("all-pending").innerHTML = response.data.pending_post;
                    document.getElementById("all-cancelled").innerHTML = response.data.cancelled_post;
                    document.getElementById("all-edit").innerHTML = response.data.edit_post;
                    document.getElementById("all-likes").innerHTML = response.data.likes;
                    }, 1000);
                    setTimeout(() => {
                    $('#editPostModal').modal('hide');
                    document.getElementById("edit-success-alert").style.display = "none";
                    $('#editPostBtn').val('Edit Post');
                    $('#editor-post').DataTable().destroy();
                    fetch_data();
                    }, 3000);
                    }

                    },
                    error: function (data) {
                    // for post title field
                    if ($.trim(data.responseJSON.errors.post_title) == 0) {
                    $("#edit-post-title-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_post_title").removeClass("input-error");
                    } else {
                    $("#edit-post-title-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_post_title").addClass("input-error");
                    document.getElementById("edit-post-title-alert").innerHTML = data.responseJSON.errors.post_title[0];
                    }

                    // for feature picture field
                    if ($.trim(data.responseJSON.errors.feature_picture) == 0) {
                    $("#edit-feature-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_feature_picture").removeClass("input-error");
                    } else {
                    $("#edit-feature-picture-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_feature_picture").addClass("input-error");
                    document.getElementById("edit-feature-picture-alert").innerHTML = data.responseJSON.errors.feature_picture[0];
                    }

                    // for category field
                    if ($.trim(data.responseJSON.errors.watermark) == 0) {
                    $("#edit-watermark").addClass("d-none").removeClass("d-block");
                    $("#edit_watermark").removeClass("input-error");
                    } else {
                    $("#edit-watermark").addClass("d-block").removeClass("d-none");
                    $("#edit_watermark").addClass("input-error");
                    document.getElementById("edit-watermark").innerHTML = data.responseJSON.errors.watermark[0];
                    }
                    // for post body field
                    if ($.trim(data.responseJSON.errors.post_body) == 0) {
                    $("#edit-post-body-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_post_body").removeClass("input-error");
                    } else {
                    $("#edit-post-body-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_post_body").addClass("input-error");
                    document.getElementById("edit-post-body-alert").innerHTML = data.responseJSON.errors.post_body[0];
                    }

                    // for category field
                    if ($.trim(data.responseJSON.errors.category) == 0) {
                    $("#edit-category").addClass("d-none").removeClass("d-block");
                    $("#edit_category").removeClass("input-error");
                    } else {
                    $("#edit-category").addClass("d-block").removeClass("d-none");
                    $("#edit_category").addClass("input-error");
                    document.getElementById("edit-category").innerHTML = data.responseJSON.errors.category[0];
                    }

                    $('#createPost').val('Create Post');
                    }
            });
            });
            // code to filter the post table using the filter button
            $('#filter').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var select_post_type = $('#select-post-type option:selected').val();
            if (start_date != '' && end_date != '' && select_post_type != '')
            {
            $('#editor-post').DataTable().destroy();
            fetch_data(start_date, end_date, select_post_type);
            } else
            {
            $('#requireDate').modal('show');
            }
            });
            // code to refresh and reset the post table
            $('#refresh').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#select-post-type').val(1);
            $('#editor-post').DataTable().destroy();
            fetch_data();
            });
            // to connect the summernote to the textarea for create post
            $(document).ready(function () {
            $('#post_body').summernote({
            placeholder: 'Enter content here..',
            });
            });
            // to connect the summernote to the textarea for edit post
            $(document).ready(function () {
            $('#edit_post_body').summernote({
            placeholder: 'E n ter co ntent here..',
            });
            });
            });

document.getElementById("all-post").innerHTML = {{$post_count_summary['all_post'] }};
            document.getElementById("all-active").innerHTML = {{$post_count_summary['approved_post'] }};
            document.getElementById("all-pending").innerHTML = {{$post_count_summary['pending_post'] }};
            document.getElementById("all-cancelled").innerHTML = {{$post_count_summary['cancelled_post'] }};
            document.getElementById("all-edit").innerHTML = {{$post_count_summary['edit_post'] }};
            document.getElementById("all-likes").innerHTML = {{$post_count_summary['likes'] }};
            document.getElementById("all-comments").innerHTML = {{$post_count_summary['comments'] }};
            