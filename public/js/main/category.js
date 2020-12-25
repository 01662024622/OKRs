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
    $(".content-toggle").on("click", function () {
        var icon = $(this);
        icon.find(".fa").toggleClass("fa-caret-down fa-caret-up");
        icon.closest(".ui-state-default").find(".sub-content").toggle();
    });


});
var users=[];
var user_find=[];
var category_id=2;
$('#staff_find').on('click',function (){
    searchStaff();
})
$('#staff_find_text').on('keyup',function (event){
    if (event.key === "Enter") {
        searchStaff()
        console.log('enter')
    }
})
function searchStaff(){
    var userQuery='';
    if(users.length>0){
        userQuery='?users[]='+users.join('&users[]=');
    }
    $.ajax({
        type: "GET",
        url: "/api/v1/users/category/search/"+$('#staff_find_text').val()+userQuery,
        success: function(response)
        {
            var html="";
            for (var i = 0; i < response.length; i++){
                html=html+'<option value="'+response[i]['id']+'" id="staff_option_'+response[i]['id']+'">'+response[i]['name']+'</option>';
                user_find[response[i]['id']]=response[i];
            }
            $('#multiple_staff_select').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}
$("#staff_select").on('click',function (){
    if ($("#multiple_staff_select").val()!="") {
        var staff_table='';
        $("#multiple_staff_select").val().forEach( function(element, index) {
            users.push(parseInt(element));
            $("#staff_option_"+element).hide(0);
            staff_table=staff_table+`<tr>
                    <td>`+user_find[element]['name']+`</td>
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


$('#apartment_find').on('click',function (){
    searchApartment();
})
$('#apartment_find_text').on('keyup',function (event){
    if (event.key === "Enter") {
        searchApartment()
    }
})
var apartment_find=[];
var apartments=[];
function searchApartment(){
    var apartmentQuery='';
    if(apartments.length>0){
        apartmentQuery='?apartments[]='+apartments.join('&apartments[]=');
    }
    $.ajax({
        type: "GET",
        url: "/api/v1/apartments/category/search/"+$('#apartment_find_text').val()+apartmentQuery,
        success: function(response)
        {
            var html="";
            for (var i = 0; i < response.length; i++){
                html=html+'<option value="'+response[i]['id']+'" id="staff_option_'+response[i]['id']+'">'+response[i]['name']+'</option>';
                apartment_find[response[i]['id']]=response[i];
            }
            $('#multiple_apartment_select').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
        }
    });
}
$("#apartment_select").on('click',function (){
    if ($("#multiple_staff_select").val()!="") {
        var apartment_table='';
        $("#multiple_apartment_select").val().forEach( function(element, index) {
            apartments.push(parseInt(element));
            $("#staff_option_"+element).hide(0);
            apartment_table=apartment_table+`<tr>
                    <td>`+apartment_find[element]['name']+`</td>
                    <td>
                        <select class="role-select" name="role" id="role">
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
// staff_table=staff_table+`<tr>
//                     <td>`+user_find[element]['name']+`</td>
//                     <td>
//                         <select class="role-select" name="role" id="role">
//                             <option value="0" `
//
// if(user_find[element]['role']===0) staff_table=staff_table+'checked';
//
// staff_table=staff_table+`>mặc định</option>
//                             <option value="1" style="font-weight: 700; color: #3ED317" `
//
// if(user_find[element]['role']===1) staff_table=staff_table+'checked';
//
// staff_table=staff_table+`>cho phép</option>
//                             <option value="2" style="font-weight: 700; color: #AA0000" `
//
// if(user_find[element]['role']===2) staff_table=staff_table+'checked';
//
// staff_table=staff_table+`>khóa tất cả</option>
//                         </select>
//                     </td>
//                 </tr>`;
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
