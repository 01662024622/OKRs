$(function () {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight"
    });
    $("#sortable").disableSelection();
    $("#sortable_sub").sortable({
        placeholder: "ui-state-highlight",
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
        },
    });
    $("#sortable_sub").disableSelection();
    $(".portlet-toggle").on("click", function () {
        var icon = $(this);
        icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
        icon.closest(".portlet").find(".portlet-content").toggle();
    });

});
var users = [];
var user_add = [];
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
                        <select class="role-select" name="role" id="role">
                            <option value="0" >mặc định</option>
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
var apartments = [];

function searchApartment() {
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
                        <select class="role-select" name="role" id="apartment_role_`+apartment_find[element]['id']+`">
                            <option value="0" >mặc định</option>
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
    users = []
    user_add = []
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
            } else $('#radio').hide();
            $('#role').val(response.role);
            $('#eid').val(response.id);
            $('#load_page').hide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}

$('#apartment_toggle').on('click', function () {
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
                apartment_table = apartment_table + `<tr>
                    <td>` + response[i]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="apartment_role_`+response[i]['id']+`">
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
                users_table = users_table + `<tr>
                    <td>` + response[i]['name'] + `</td>
                    <td>
                        <select class="role-select" name="role" id="apartment_role_`+response[i]['id']+`">
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
