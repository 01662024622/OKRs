$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight",
        items: "li:not(.disable-sort-item)"
    });
    $("#sortable").disableSelection();
    $(".portlet-toggle").on("click", function () {
        var icon = $(this);
        icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
        icon.closest(".portlet").find(".portlet-content").toggle();
    });

});
var users = [];
var user_add = [];
var user_update = [];
var user_find = [];
$('#staff_find').on('click', function () {
    searchStaff();
})
$('#staff_find_text').on('keyup', function (event) {
    if (event.key === "Enter") {
        searchStaff()
    }
})

function searchStaff() {
    if ($('#staff_find_text').val() == '') return
    $('#load_page').show()
    var userQuery = '';
    if (users.length > 0) {
        userQuery = '?users[]=' + users.join('&users[]=');
    }
    $.ajax({
        type: "GET",
        url: "/api/v1/users/category/search/" + $('#staff_find_text').val() + userQuery,
        success: function (response) {
            var html = "";
            for (var i = 0; i < response.length; i++) {
                html = html + '<option value="' + response[i]['id'] + '" id="staff_option_' + response[i]['id'] + '">' + response[i]['name'] + '</option>';
                user_find[response[i]['id']] = response[i];
            }
            $('#multiple_staff_select').html(html);

            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}

$("#staff_select").on('click', function () {
    if ($("#multiple_staff_select").val() != "") {
        var staff_table = '';
        $("#multiple_staff_select").val().forEach(function (element, index) {
            users.push(parseInt(element));
            user_add.push(parseInt(element));
            $("#staff_option_" + element).hide(0);
            staff_table = staff_table + `<tr>
                    <td>` + user_find[element]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="user_role_` + user_find[element]['id'] + `">
                            <option value="0" selected>mặc định</option>
                            <option value="1" style="font-weight: 700; color: #3ED317" >Cho phép</option>
                            <option value="2" style="font-weight: 700; color: #AA0000" >Chặn</option>
                        </select>
                    </td>
                </tr>`;

        });
        $('#staff_role_table').append(staff_table);

    }
})


$('#apartment_find').on('click', function () {
    searchApartment();
})
$('#apartment_find_text').on('keyup', function (event) {
    if (event.key === "Enter") {
        searchApartment()
    }
})
var apartment_find = [];
var apartment_add = [];
var apartment_update = [];
var apartments = [];

function searchApartment() {
    if ($('#apartment_find_text').val() == '') return
    $('#load_page').show()
    var apartmentQuery = '';
    if (apartments.length > 0) {
        apartmentQuery = '?apartments[]=' + apartments.join('&apartments[]=');
    }
    $.ajax({
        type: "GET",
        url: "/api/v1/apartments/category/search/" + $('#apartment_find_text').val() + apartmentQuery,
        success: function (response) {
            var html = "";
            for (var i = 0; i < response.length; i++) {
                html = html + '<option value="' + response[i]['id'] + '" id="staff_option_' + response[i]['id'] + '">' + response[i]['name'] + '</option>';
                apartment_find[response[i]['id']] = response[i];
            }
            $('#multiple_apartment_select').html(html);

            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}

$("#apartment_select").on('click', function () {
    if ($("#multiple_staff_select").val() != "") {
        var apartment_table = '';
        $("#multiple_apartment_select").val().forEach(function (element, index) {
            apartments.push(parseInt(element));
            apartment_add.push(parseInt(element));
            $("#staff_option_" + element).hide(0);
            apartment_table = apartment_table + `<tr>
                    <td>` + apartment_find[element]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="apartment_role_` + apartment_find[element]['id'] + `">
                            <option value="0" selected>mặc định</option>
                            <option value="1" style="font-weight: 700; color: #3ED317" >Cho phép</option>
                            <option value="2" style="font-weight: 700; color: #AA0000" >Chặn</option>
                        </select>
                    </td>
                </tr>`;

        });
        $('#apartment_role_table').append(apartment_table);

    }
})

// get data for form update
function getInfo(id) {
    $('#nav_active')[0].click();
    apartments = []
    apartment_add = []
    apartment_update = []
    users = []
    user_add = []
    user_update = []
    apartment_find = []
    $('#load_page').show()
    $.ajax({
        type: "GET",
        url: "/categories/" + id,
        success: function (response) {
            $('#title').val(response.title);
            $('#url').val(response.url);
            if (response.parent_id == 0) {
                $("#radio_" + response.type).attr('checked', 'checked');
                $('#radio').show();
                $('#url_group').hide();
                $('#url').val('');
            } else {
                $('#radio').hide();
                $('#url_group').show();
            }
            $('#role').val(response.role);
            $('#eid').val(response.id);
            $('#parent_id').val(response.parent_id);
            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}

$('#apartment_toggle').on('click', function () {
    if ($('#eid').val() == '') return
    if (apartments.length>0) return
    $('#load_page').show()
    $.ajax({
        type: "GET",
        url: "/api/v1/apartments/category/role/" + $('#eid').val(),
        success: function (response) {
            var apartment_table = `<tr>
                                                <th>Phòng ban</th>
                                                <th>Quyền hạn</th>
                                            </tr>`;
            for (var i = 0; i < response.length; i++) {
                apartments.push(response[i]['id'])
                apartment_update.push(response[i]['ca_id'])
                apartment_table = apartment_table + `<tr>
                    <td>` + response[i]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="apartment_role_update_` + response[i]['ca_id'] + `">
                            <option value="0" `

                if (response[i]['role'] == 0) apartment_table = apartment_table + 'selected';

                apartment_table = apartment_table + `>mặc định</option>
                            <option value="1" style="font-weight: 700; color: #3ED317" `

                if (response[i]['role'] == 1) apartment_table = apartment_table + 'selected';

                apartment_table = apartment_table + `>cho phép</option>
                            <option value="2" style="font-weight: 700; color: #AA0000" `

                if (response[i]['role'] == 2) apartment_table = apartment_table + 'selected';

                apartment_table = apartment_table + `>Chặn</option>
                        </select>
                    </td>
                </tr>`;
            }

            $('#apartment_role_table').html(apartment_table);

            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
})

$('#staff_toggle').on('click', function () {
    if ($('#eid').val() == '') return
    if (users.length>0) return
    $('#load_page').show()
    $.ajax({
        type: "GET",
        url: "/api/v1/users/category/role/" + $('#eid').val(),
        success: function (response) {
            var users_table = `<tr>
                                                <th>Nhân viên</th>
                                                <th>Quyền hạn</th>
                                            </tr>`;
            for (var i = 0; i < response.length; i++) {
                users.push(response[i]['id'])
                user_update.push(response[i]['ca_id'])
                users_table = users_table + `<tr>
                    <td>` + response[i]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="user_role_update_` + response[i]['ca_id'] + `">
                            <option value="0" `

                if (response[i]['role'] == 0) users_table = users_table + 'selected';

                users_table = users_table + `>mặc định</option>
                            <option value="1" style="font-weight: 700; color: #3ED317" `

                if (response[i]['role'] == 1) users_table = users_table + 'selected';

                users_table = users_table + `>cho phép</option>
                            <option value="2" style="font-weight: 700; color: #AA0000" `

                if (response[i]['role'] == 2) users_table = users_table + 'selected';

                users_table = users_table + `>Chặn</option>
                        </select>
                    </td>
                </tr>`;
            }
            $('#staff_role_table').html(users_table);

            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
})

function add_new() {
    $('#eid').val('');
    $('#title').val('');
    $('#url').val('');
    $("#radio_1").attr('checked', 'checked');
    $('#radio').show();
    $('#url_group').hide();
    $('#role').val(0);
    $('#parent_id').val(0);
    apartments = [];
    apartment_add = [];
    apartment_update = [];
    users = [];
    user_add = [];
    user_update = [];
    var users_table = `<tr>
                                                <th>Nhân viên</th>
                                                <th>Quyền hạn</th>
                                            </tr>`;

    $('#staff_role_table').html(users_table);
    var apartment_table = `<tr>
                                                <th>Phòng ban</th>
                                                <th>Quyền hạn</th>
                                            </tr>`;

    $('#apartment_role_table').html(apartment_table);

    $('#nav_active')[0].click();
}

$("#save").on('click', function () {
    if ($('#title').val() == '') {
        toastr.error('Tiêu đề không được phép rỗng!');
        return;
    }
    $('#load_page').show();
    var formData = new FormData();
    if ($('#eid').val() != '') {
        formData.append('id', $('#eid').val());
    }

    formData.append('title', $('#title').val());
    if ($('#url').val() != '') {
        formData.append('url', $('#url').val());
    }
    formData.append('parent_id', $('#parent_id').val());

    formData.append('role', $('#role').val());
    if ($('#parent_id').val()==0){
        formData.append('type', $('input[name=type]:checked').val());
    }
    if (user_add.length > 0) {
        user_add.forEach(element => {
            formData.append('users[]', element + '_' + $("#user_role_" + element).val());
        })
    }
    if (user_update.length > 0) {
        user_update.forEach(element => {
            formData.append('user_update[]', element + '_' + $("#user_role_update_" + element).val());
        })
    }
    if (apartment_add.length > 0) {
        apartment_add.forEach(element => {
            formData.append('apartments[]', element + '_' + $("#apartment_role_" + element).val());
        })
    }
    if (apartment_update.length > 0) {
        apartment_update.forEach(element => {
            formData.append('apartment_update[]', element + '_' + $("#apartment_role_update_" + element).val());
        })
    }
    console.log(formData)
    $.ajax({
        url: "/categories",
        type: "POST",
        data: formData,
        dataType: 'json',
        async: false,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response)
            setTimeout(function () {
                if ($('#eid').val() == '') {
                    toastr.success('Thêm mới thành công!');
                } else {
                    toastr.success('Cập nhật thành công!');
                }
            }, 1000);
            $("#myModal").modal('toggle');
            var type='';
            if (response['type']==2) type='style="background-color: #ccff99"';
            if ($('#eid').val() == '' && $('#parent_id').val() == 0) {
                var li = `<li class="ui-state-default" data-value="`+response['id']+`">
                <div class="main-header"`+type+`>
                    <p class="main-title header" title="`+response['title']+`">`+response['title']+`</p>
                    <button class='btn menu-icon' data-toggle="modal" data-target="#myModal" onclick="getInfo(`+response['id']+`)">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="main-content">
                    <ul id="sortable_sub_`+response['id']+`" class="sortable_sub">
<!--                            <li class="ui-state-default" data-value="{{$sub->id}}">-->
<!--                                <div class="sub-header">-->
<!--                                    <p class="sub-title header" title="{{$sub->title}}">{{$sub->title}}</p>-->
<!--                                    <button class='btn menu-icon' data-toggle="modal" data-target="#myModal" onclick="getInfo({{$sub->id}})">-->
<!--                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                            </li>-->
                    </ul>
                </div>

            </li>`;
            $('#add_button_category').before(li);
            }
            $('#load_page').hide();
        }, error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        },
    });
});

// $.ajax({
//     type: "GET",
//     url: "/api/v1/users/role/"+category_id+userQuery,
//     success: function(response)
//     {
//
//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//         toastr.error(thrownError);
//     }
// });
