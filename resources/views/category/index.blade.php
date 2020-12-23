@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/main/category.css') }}">
@endsection
@section('content')


    <ul id="sortable">
        <li class="ui-state-default">
            <div class="main-header">
                <p class="main-title header" title="Shoppingpppppppppppppppppppppppp">Shoppingpp</p>
                <button class='btn menu-icon'><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
            </div>
            <div class="main-content">
                <ul id="sortable_sub">
                    <li class="ui-state-default">
                        <div class="sub-header">
                            <p class="sub-title header">Shopping</p>
                            <button class='btn menu-icon content-toggle'><i class="fa fa-caret-down"
                                                                            aria-hidden="true"></i></button>
                        </div>
                        <div class="sub-content">
                            <form>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">URL</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="Nhập url">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputPassword1">Nhãn Điều Hướng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nhập nhãn điều hướng">
                                </div>
                                <button type="submit" class="sub-button-submit">Lưu</button>
                                <button type="submit" class="sub-button-remove">Xóa</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </li>
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
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
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">URL</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="Nhập url">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputPassword1">Nhãn Điều Hướng</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                   placeholder="Nhập nhãn điều hướng">
                        </div>

                        <div class="form-group">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type" value="1" checked>Danh mục chính
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type" value="2">Danh mục nhóm
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#all">Tổng thể</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#apartment">Phòng ban</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#staff">Nhân viên</a>
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
                                                            <option value="1" style="font-weight: 700; color: #3ED317">cho phép</option>
                                                            <option value="2" style="font-weight: 700; color: #AA0000">khóa tất cả</option>
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
                                            <input type="text" name="apartment_find" id="apartment_find" style="width: 150px;" maxlength="30"> <button>Tìm kiếm</button>
                                            <br>
                                            <p>Kết quả tìm kiếm:</p>
                                            <br>
                                            <select multiple="multiple" id="multiple_apartment" style="height:160px; width: 210px;">

                                            </select>
                                        </div>
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
                                                            <option value="1" style="font-weight: 700; color: #3ED317">cho phép</option>
                                                            <option value="2" style="font-weight: 700; color: #AA0000">khóa tất cả</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="staff" class="container tab-pane fade"><br>
                                    <div class="row">
                                        <div class="col col-6">
                                            <input type="text" name="apartment_find" id="apartment_find" style="width: 150px;" maxlength="30"> <button>Tìm kiếm</button>
                                            <br>
                                            <p>Kết quả tìm kiếm:</p>
                                            <br>
                                            <select multiple="multiple" id="multiple_apartment" style="height:160px; width: 210px;">

                                            </select>
                                        </div>
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
                                                            <option value="1" style="font-weight: 700; color: #3ED317">cho phép</option>
                                                            <option value="2" style="font-weight: 700; color: #AA0000">khóa tất cả</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Lưu</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/main/category.js') }}"></script>

@endsection
