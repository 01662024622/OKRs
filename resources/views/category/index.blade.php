@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/main/category.css') }}">
@endsection
@section('content')


    <ul id="sortable">
        @foreach ($categories as $category)
            <li class="ui-state-default">
                <div class="main-header">
                    <p class="main-title header" title="{{$category->title}}">{{$category->title}}</p>
                    <button class='btn menu-icon' data-toggle="modal" data-target="#myModal" onclick="getInfo({{$category->id}})">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="main-content">
                    <ul id="sortable_sub">
                        @foreach ($category->children as $sub)
                            <li class="ui-state-default">
                                <div class="sub-header">
                                    <p class="sub-title header" title="{{$sub->title}}">{{$sub->title}}</p>
                                    <button class='btn menu-icon' data-toggle="modal" data-target="#myModal" onclick="getInfo({{$sub->id}})">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </li>
        @endforeach
        <li class="ui-state-default">2</li>
        <li class="ui-state-default">3</li>
        <li class="ui-state-default">4</li>
        <li class="ui-state-default">5</li>
        <li class="ui-state-default">6</li>
        <li class="ui-state-default">7</li>
        <li class="ui-state-default">8</li>
        <li class="ui-state-default">9</li>
        <li class="ui-state-default">10</li>
        <li class="ui-state-default">11</li>
        <li class="ui-state-default">12</li>
    </ul>
    <button type="button" class="btn btn-primary">
        Open modal
    </button>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cấu hình danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">Nhãn Điều Hướng</label>
                        <input type="text" class="form-control" id="title"
                               placeholder="Nhập nhãn điều hướng...">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">URL</label>
                        <input type="text" class="form-control" id="url" aria-describedby="emailHelp"
                               placeholder="Nhập url...">
                    </div>
                    <div class="form-group" id="radio">
                        <form action="#">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" id="radio_1" class="form-check-input" name="type" value="1"
                                           checked>Danh mục nhóm
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" id="radio_0" class="form-check-input" name="type" value="0">Danh
                                    mục chính
                                </label>
                            </div>
                        </form>
                    </div>

                    <div class="form-group">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#all" id="nav_active">Tổng thể</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#apartment" id="apartment_toggle">Phòng ban</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#staff" id="staff_toggle">Nhân viên</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="all" class="container tab-pane active"><br>
                                <div class="row">
                                    <div class="col col-6">
                                        <table style="width:100%">
                                            <tr>
                                                <th>Vai trò</th>
                                                <th>Cấp phép</th>
                                            </tr>
                                            <tr>
                                                <td>Nhân Viên</td>
                                                <td>
                                                    <select class="role-select" name="role" id="role">
                                                        <option value="0">mặc định</option>
                                                        <option value="1" style="font-weight: 700; color: #3ED317">cho
                                                            phép
                                                        </option>
                                                        <option value="2" style="font-weight: 700; color: #AA0000">khóa
                                                            tất cả
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col col-6"></div>
                                </div>
                            </div>
                            <div id="apartment" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col col-6">
                                        <input type="text" name="apartment_find" id="apartment_find_text"
                                               style="width: 150px;" maxlength="30">
                                        <button id="apartment_find">Tìm kiếm</button>
                                        <br>
                                        <br>
                                        <p>Kết quả tìm kiếm:</p>
                                        <select multiple="multiple" id="multiple_apartment_select"
                                                style="height:160px; width: 210px;">

                                        </select>

                                        <button id="apartment_select">Chọn</button>
                                    </div>
                                    <div class="col col-6">
                                        <table style="width:100%" id="apartment_role_table">
                                            <tr>
                                                <th>Phòng ban</th>
                                                <th>Quyền hạn</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="staff" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col col-6">
                                        <input type="text" name="apartment_find" id="staff_find_text"
                                               style="width: 150px;" maxlength="30">
                                        <button id="staff_find">Tìm kiếm</button>
                                        <br>
                                        <p>Kết quả tìm kiếm:</p>
                                        <br>
                                        <select multiple="multiple" id="multiple_staff_select"
                                                style="height:160px; width: 210px;">

                                        </select>
                                        <button id="staff_select">Chọn</button>
                                    </div>
                                    <div class="col col-6">
                                        <table style="width:100%" id="staff_role_table">
                                            <tr>
                                                <th>Nhân viên</th>
                                                <th>Quyền hạn</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input id="eid" type="hidden">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Lưu</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/main/category.js') }}"></script>

@endsection
