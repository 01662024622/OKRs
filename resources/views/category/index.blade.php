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
                            <button class='btn menu-icon content-toggle'><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        </div>
                        <div class="sub-content">
                            <form>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">URL</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập url">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputPassword1">Nhãn Điều Hướng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập nhãn điều hướng">
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



@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/main/category.js') }}"></script>

@endsection
