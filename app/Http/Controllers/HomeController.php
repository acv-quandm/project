<?php

namespace App\Http\Controllers;

use App\Drug;
use App\Lecturer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }
    public function replacePassword(Request $request){
        $user = Auth::user();
        if(Hash::check($request->old_password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back();
        }
        else{
            return back()->withErrors([
                'error' => 1
            ]);
        }
    }

    public function insert(){


        /*$ho = ['Trần','Nguyễn','Lê','Hoàng','Bùi','Lương','Đỗ','Đậu','Phan','Đàm','Phạm','Đặng','Vũ','Võ','Hồ','Ngô','Lý'];
        $ten_dem_nu = ['Ái','An','Anh','Thị','Bạch','Bảo'];
        $ten_dem_nam = ['Văn','Minh','Hồng','Xuân'];
        $ten_nu = ['Linh','Hằng','Huệ','Châu','Chi','Phương','Diệp','Điệp','Lan','Hoa','Ánh','Ngọc','Hương','Trầm','Hồng'];
        $ten_nam = ['Nam','Hùng','Cường','Hào','Trung','Tuấn','Quân','Danh','Khánh','Dương','Khôi','Đạt','Vũ'];
        $gioi_tinh = ['Nam','Nu'];
        $tinh = ["An Giang","Bà Rịa - Vũng Tàu","Bắc Giang","Bắc Kạn","Bạc Liêu","Bắc Ninh","Bến Tre","Bình Định","Bình Dương","Bình Phước","Bình Thuận","Cà Mau","Cao Bằng","Đắk Lắk","Đắk Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai","Hà Giang","Hà Nam","Hà Tĩnh","Hải Dương","Hậu Giang","Hòa Bình","Hưng Yên","Khánh Hòa","Kiên Giang","Kon Tum","Lai Châu","Lâm Đồng","Lạng Sơn","Lào Cai","Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huế","Tiền Giang","Trà Vinh","Tuyên Quang","Vĩnh Long","Vĩnh Phúc","Yên Bái","Phú Yên"];
        $khoa = [1,2,3,4];
        for($i = 0; $i< 100 ;$i++){

            try{
                $random_gioi_tinh =$gioi_tinh[array_rand($gioi_tinh,1)];
                $lecturer = new Lecturer();
                if($random_gioi_tinh == 'Nam')
                {

                    $lecturer->name = $ho[array_rand($ho,1)].' '.$ten_dem_nam[array_rand($ten_dem_nam,1)].' '.$ten_nam[array_rand($ten_nam,1)];
                }
                if($random_gioi_tinh == 'Nu')
                {
                    $lecturer->name = $ho[array_rand($ho,1)].' '.$ten_dem_nu[array_rand($ten_dem_nu,1)].' '.$ten_nu[array_rand($ten_nu,1)];
                }
                $lecturer->birthday = Carbon::now()->subDays(rand(9000, 16200))->format('Y-m-d');
                $lecturer->address = $tinh[array_rand($tinh,1)];
                $lecturer->email = strtolower(str_replace(" ","",$this->vn_to_str(  $lecturer->name)).'@gmail.com');
                $randomNumber = '';
                for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 6; $i++) {
                    $randomNumber .= mt_rand(0, 9);
                }
                $lecturer->phone_number = '0168'.$randomNumber;
                $lecturer->department_id = $khoa[array_rand($khoa,1)];
                $user = new User();
                $user->email = $lecturer->email;
                $user->name = $lecturer->name;
                $user->password = Hash::make($user->email);
                $user->save();
                $lecturer->user_id = $user->id;
                $lecturer->save();
            }catch (\Exception $exception){

            }

        }*/
        $vi_tri = ['hay','chân','miệng','lưng','đầu','bụng','họng'];
        $buoi = ['Sáng','Trưa','Chiều','Tối'];
        $so_luong = ['hai','một','ba'];
        $dang = ['viên','gói'];
        for($i = 0 ; $i < 100; $i++){
           try{
               $drug = new Drug();
               $drug->name ='Thuốc chữa đau '.$vi_tri[array_rand($vi_tri,1)];
               $drug->use = 'Sử dụng '.$so_luong[array_rand($so_luong,1)].' '.$dang[array_rand($dang,1)].
                   ' vào buổi '.$buoi[array_rand($buoi,1)];
               $drug->amount = 100;
               $drug->save();
           }catch (\Exception $exception){

           }
        }
        die('Done');
    }
    public function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);

        return $str;

    }
}
