<?php

namespace App\Http\Controllers\DataApi;

use App\Apartment;
use App\Feedback;
use App\FeedbackPR;
use App\FeedbackWarehouse;
use App\Http\Controllers\Controller;
use App\Model\HT10\Review;
use App\Review360;
use App\ReviewIprove360;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportApiController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function reviewData()
    {
        $data = Review::select("ht10-reviews.*", "apartments.name as apartment", "users.name as user")
            ->leftJoin('users', 'users.id', '=', 'ht10-reviews.user_id')
            ->join('apartments', 'ht10-reviews.apartment_id', '=', 'apartments.id')
            ->orderBy('ht10-reviews.updated_at', 'desc')
            ->where('ht10-reviews.create_by', Auth::id());

        // $products->user;
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user', function ($dt) {
                if ($dt['user'] == null) {
                    return "Feedback Phòng ban";
                } else {
                    return $dt['user'];
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->editColumn('image', function ($dt) {
                return '<img class="image-report" src="' . $dt['image'] . '">';
            })

//            ->editColumn('confirm', function ($dt) {
//                return '<img class="image-report" src="' . $dt['image'] . '">';
//            })
            ->setRowId('data-{{$id}}')
            ->rawColumns(['content', 'image'])
            ->make(true);
    }

    public function feedbackMeData()
    {
        $date = Carbon::today()->subDay(2);
        $data = Review::select("ht10-reviews.*",
            DB::raw("(CASE WHEN `ht10-reviews`.user_status = 1 THEN 1 WHEN `ht10-reviews`.created_at < '" . $date . "' THEN 2 WHEN `ht10-reviews`.user_status = -1 THEN -1 ELSE 0 END) as role"))
            ->orderBy('ht10-reviews.updated_at', 'desc')
            ->where('ht10-reviews.user_id', Auth::id());
//        ->where('ht10-reviews.created_at',">",$date);
        // $products->user;
        return Datatables::of($data)
            ->addColumn('action', function ($dt) {
                if ($dt['role'] == 0) {
                    return '<select class="form-control" id="feedback_'.$dt["id"].'" onchange="setStatus('.$dt["id"].')" name="sellist1">
                                <option value="0" selected disabled>Chưa duyệt</option>
                                <option class="bg-info" value="-1">Bác bỏ</option>
                                <option class="bg-warning" value="1">Chấp thuận</option>
                              </select>';
                }
                if ($dt['role']==1){
                    return "Đã chấp thuận";
                }
                if ($dt['role']==-1){
                    return "Đã phản hồi";
                }
                if ($dt['role']==2){
                    return "Tự động ghi nhận";
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->editColumn('image', function ($dt) {
                return '<img class="image-report" src="' . $dt['image'] . '">';
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function feedbackApartmentData()
    {
        $apartment = Apartment::where('user_id', Auth::id())->where('status', 0)->get();
        if (sizeof($apartment) < 1) return null;
        $date = Carbon::now()->subDay(2);
        $data = Review::select("ht10-reviews.*", "apartments.name as apartment", "users.name as user",
            DB::raw("(CASE WHEN `ht10-reviews`.user_status = 1 THEN 1 WHEN `ht10-reviews`.created_at < '" . $date . "' THEN 2 WHEN `ht10-reviews`.user_status = -1 THEN -1 ELSE 0 END) as role"))
            ->join('apartments', 'ht10-reviews.apartment_id', '=', 'apartments.id')
            ->leftJoin('users', 'users.id', '=', 'ht10-reviews.user_id')
            ->orderBy('ht10-reviews.updated_at', 'desc')
            ->where("apartments.user_id", Auth::id());
        return Datatables::of($data)
            ->addColumn('action', function ($dt) {
                if ($dt['role'] == 0) {
                    return '<select class="form-control" id="feedback_'.$dt["id"].'" onchange="setStatus('.$dt["id"].')" name="sellist1">
                                <option value="0" selected disabled>Chưa duyệt</option>
                                <option class="bg-info" value="-1">Bác bỏ</option>
                                <option class="bg-warning" value="1">Chấp thuận</option>
                              </select>';
                }
                if ($dt['role']==1){
                    return "Đã chấp thuận";
                }
                if ($dt['role']==-1){
                    return "Đã phản hồi";
                }
                if ($dt['role']==2){
                    return "Tự động ghi nhận";
                }
            })
            ->editColumn('image', function ($dt) {
                return '<img class="image-report" src="' . $dt['image'] . '">';
            })
            ->editColumn('name', function ($dt) {
                if ($dt['name'] == null) {
                    return "Feedback Phòng ban";
                } else {
                    return $dt['name'];
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function feedbackBrowserData()
    {
        if (Auth::user()->role != "manager") {
            if (Auth::user()->role != "admin") return null;
        }
        $date = Carbon::now()->subDay(2);
        $data = Review::select("ht10-reviews.*", "apartments.name as apartment", "users.name as user")
            ->join('apartments', 'ht10-reviews.apartment_id', '=', 'apartments.id')
            ->leftJoin('users', 'users.id', '=', 'ht10-reviews.user_id')
            ->orderBy('ht10-reviews.created_at', 'desc')
            ->where('ht10-reviews.created_at', "<", $date);
        return Datatables::of($data)
            ->addColumn('action', function ($dt) {
                $html = '<select class="form-control" id="role_' . $dt['id'] . '" onchange="changeStatus(' . $dt['id'] . ')">';
                if ($dt['status'] == 1) {
                    $html .= '<option value="1" selected style="background-color: #F46D66">Ghi Nhận</option><option value="-1" style="background-color: #57E999">Bác Bỏ</option><option value="0" style="background-color: #E5EB37" disabled>Chưa Duyệt</option>';
                } elseif ($dt['status'] == 0) {
                    $html .= '<option value="1" style="background-color: #F46D66">Ghi Nhận</option><option value="-1" style="background-color: #57E999" selected>Bác Bỏ</option><option value="0" style="background-color: #E5EB37" disabled selected>Chưa Duyệt</option>';
                } else {
                    $html .= '<option value="1" style="background-color: #F46D66">Ghi Nhận</option><option value="-1" style="background-color: #57E999" selected>Bác Bỏ</option><option value="0" style="background-color: #E5EB37" disabled>Chưa Duyệt</option>';
                }

                $html .= '</select>';
                return $html;

            })
            ->editColumn('name', function ($dt) {
                if ($dt['name'] == null) {
                    return "Feedback Phòng ban";
                } else {
                    return $dt['name'];
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->editColumn('image', function ($dt) {
                return '<img class="image-report" src="' . $dt['image'] . '">';
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->rawColumns(['action', 'image'])
            ->make(true);
    }


    public function feedbackWarehouseData()
    {
        $data = FeedbackWarehouse::select(DB::raw("feedback_warehouse.id,feedback_warehouse.amount,feedback_warehouse.code_product,feedback_warehouse.type,GROUP_CONCAT(CONCAT('- ', improve_360.content) SEPARATOR '<br>') as content"))
            ->leftjoin('feedback_warehouse_improve', 'feedback_warehouse.id', '=', 'feedback_warehouse_improve.feedback_warehouse_id')
            ->leftjoin('improve_360', 'improve_360.id', '=', 'feedback_warehouse_improve.improve_360_id')
            ->leftjoin('users', 'users.id', '=', 'feedback_warehouse.user_id')
            ->orderBy('feedback_warehouse.updated_at', 'desc')
            ->groupBy("feedback_warehouse.id", "feedback_warehouse.code_product", "feedback_warehouse.amount", "feedback_warehouse.type", "feedback_warehouse.created_at")
            ->where("feedback_warehouse.user_id", Auth::id());

        return Datatables::of($data)
            ->editColumn('type', function ($dt) {
                if ($dt['type'] == 'CC') {
                    return "Chạy cửa";
                } elseif ($dt['type'] == 'BT') {
                    return "Bỏ toa";
                } elseif ($dt['type'] == 'SKU') {
                    return "SKU";
                } else {
                    return "Chất lượng";
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->rawColumns(['action', 'apartment_id', 'content'])
            ->make(true);
    }

    public function feedbackWarehouseDataManager()
    {
        $apartment_user = Apartment::select('id')->where('status', 0)->where('user_id', \Auth::id())->get()->pluck('id')->toArray();
        if (!(in_array(20, $apartment_user, true) || Auth::user()->role != "user")) return null;
        $data = FeedbackWarehouse::select(DB::raw("feedback_warehouse.id,feedback_warehouse.amount,feedback_warehouse.code_product,feedback_warehouse.type,feedback_warehouse.created_at,GROUP_CONCAT(CONCAT('- ', improve_360.content) SEPARATOR '<br>') as content"))
            ->leftjoin('feedback_warehouse_improve', 'feedback_warehouse.id', '=', 'feedback_warehouse_improve.feedback_warehouse_id')
            ->leftjoin('improve_360', 'improve_360.id', '=', 'feedback_warehouse_improve.improve_360_id')
            ->leftjoin('users', 'users.id', '=', 'feedback_warehouse.user_id')
            ->orderBy('feedback_warehouse.updated_at', 'desc')
            ->groupBy("id", "amount", "type", "code_product", "feedback_warehouse.created_at");

        return Datatables::of($data)
            ->editColumn('type', function ($dt) {
                if ($dt['type'] == 'CC') {
                    return "Chạy cửa";
                } elseif ($dt['type'] == 'BT') {
                    return "Bỏ toa";
                } elseif ($dt['type'] == 'SKU') {
                    return "SKU";
                } else {
                    return "Chất lượng";
                }
            })
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->rawColumns(['action', 'apartment_id', 'content'])
            ->make(true);
    }

    public function feedbackPRData()
    {
        $data = FeedbackPR::where("user_id", Auth::id())->orderBy('updated_at', 'desc')->get();

        return Datatables::of($data)
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->make(true);
    }

    public function feedbackPRDataManager()
    {
        $data = FeedbackPR::orderBy('updated_at', 'desc')->get();

        return Datatables::of($data)
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->make(true);
    }

    public function feedbackCustomerData()
    {
        $data = Feedback::where("user_id", Auth::id())->orderBy('updated_at', 'desc')->get();

        return Datatables::of($data)
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->make(true);
    }

    public function feedbackCustomerDataManager()
    {
        $data = Feedback::select("feedbacks.*", "users.name")
            ->join("users", "feedbacks.user_id", "=", "users.id")
            ->orderBy('updated_at', 'desc')->get();

        return Datatables::of($data)
            ->editColumn('created_at', function ($dt) {
                return Carbon::parse($dt['created_at'])->format('d/m/Y');
            })
            ->addIndexColumn()
            ->setRowId('data-{{$id}}')
            ->make(true);
    }

    public function status(Request $request, $id)
    {
        $data = ReviewIprove360::find($id)->update(array('status' => $request->status));
        return $data;
    }
}
