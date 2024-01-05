<?php

namespace App\Http\Controllers;

use App\Mail\NoticeMail;
use App\Mail\ReplyMail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Page;
use App\Models\Social;
use App\Models\NewsLetter;
use App\Models\Contact;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Slider;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
// use Mail;
use Illuminate\Support\Facades\Mail;

class BackController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function home()
    {
        return view('back.home.home');
    }


    #=============Staff Manager============#
    public function staff_profile()
    {
        return view('back.staff.profile');
    }

    public function staff_profile_post(Request $request)
    {
        if (empty($request->fullname) || empty($request->email) || empty($request->phone)) {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $user = User::find($request->id);
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if (isset($request->password) && $request->password != '') {
            $user->password = bcrypt($request->password);
        }

        $flag = $user->save();
        if ($flag == true) {
            return redirect('admin/staff/profile')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thông tin tài khoản thành công']);
        } else {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Chỉnh sửa tài khoản không thành công']);
        }
    }

    public function staff_list(Request $request)
    {
        $user = DB::table('users as a')->join('users_level as b', 'a.level', '=', 'b.id')->selectRaw('a.id, a.fullname, a.address, a.email, a.phone, b.name')->get();
        return view('back.staff.list', compact('user'));
    }


    public function staff_add()
    {
        $userLevel = UserLevel::where('status', 1)->get();
        return view('back.staff.add', compact('userLevel'));
    }

    public function staff_add_post(Request $request)
    {
        if (empty($request->fullname) || empty($request->email) || empty($request->phone) || empty($request->password) || empty($request->username)) {
            return redirect('admin/staff/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $user = new User;
        $user->level = $request->level;
        $user->status = 1;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $flag = $user->save();

        if ($flag == true) {
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm nhân viên thành công']);
        } else {
            return redirect('admin/staff/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm nhân viên']);
        }
    }

    public function staff_edit(Request $request, $id)
    {
        $user = User::find($id);
        $userLevel = UserLevel::where('status', 1)->get();
        return view('back.staff.edit', compact('user', 'userLevel'));
    }

    public function staff_edit_post(Request $request, $id)
    {
        if (empty($request->fullname) || empty($request->email) || empty($request->phone)) {
            return redirect('admin/staff/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'email' => $request->email,
            'phone' => $request->phone,
            'level' => $request->level,
            'address' => $request->address,
            'fullname' => $request->fullname,
            'status' => $request->status,
        ];

        if (isset($request->password) && $request->password != '') {
            $data['password'] = bcrypt($request->password);
        }

        $flag = User::where('id', $id)->update($data);

        if ($flag) {
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thông tin nhân viên thành công']);
        } else {
            return redirect('admin/staff/edit')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi cập nhật thông tin nhân viên']);
        }
    }

    public function staff_delete(Request $request, $id)
    {
        $user = User::find($id);
        $flag = $user->delete();

        if ($flag) {
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá nhân viên thành công']);
        } else {
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá nhân viên']);
        }
    }
    #=============End Staff Manager============#    

    #=============System Manager============#
    public function system()
    {
        $name = System::where('status', 1)->where('Code', 'name')->first();
        $logo = System::where('status', 1)->where('Code', 'logo')->first();
        $favicon = System::where('status', 1)->where('Code', 'favicon')->first();
        $email = System::where('status', 1)->where('Code', 'email')->first();
        $phone = System::where('status', 1)->where('Code', 'phone')->first();
        $address = System::where('status', 1)->where('Code', 'address')->first();
        $copyright = System::where('status', 1)->where('Code', 'copyright')->first();
        return view('back.system.system', compact(
            'name',
            'logo',
            'favicon',
            'email',
            'phone',
            'address',
            'copyright'
        ));
    }

    public function system_post(Request $request)
    {
        // Kiểm tra các trường bắt buộc
        $requiredFields = ['name', 'email', 'phone'];
        foreach ($requiredFields as $field) {
            if (empty($request->$field)) {
                return redirect('admin/system')->with([
                    'flash_level' => 'danger',
                    'flash_message' => 'Vui lòng điền vào các trường có *'
                ]);
            }
        }

        $updateFields = ['name', 'email', 'phone', 'address', 'copyright'];

        foreach ($updateFields as $field) {
            System::where('Status', 1)
                ->where('Code', $field)
                ->update(['Description' => $request->$field]);
        }

        # logo
        if (!empty($request->file('logo'))) {
            $logo = System::where('Status', 1)->where('Code', 'logo')->first();

            if ($logo) {
                $path = 'resources/images/logo/' . $logo->Description;

                if (File::exists($path)) {
                    File::delete($path);
                }
                $name = $request->file('logo')->getClientOriginalName();
                $request->file('logo')->move('resources/images/logo/', $name);

                $logo->Description = $name;
                $logo->save();
            }
        }

        if (!empty($request->file('favicon'))) {
            $favicon = System::where('Status', 1)->where('Code', 'favicon')->first();

            if ($favicon) {
                $path = 'resources/images/favicon/' . $favicon->Description;

                if (File::exists($path)) {
                    File::delete($path);
                }
                $name = $request->file('favicon')->getClientOriginalName();
                $request->file('favicon')->move('resources/images/favicon/', $name);

                $favicon->Description = $name;
                $favicon->save();
            }
        }

        return redirect('admin/system')->with([
            'flash_level' => 'success',
            'flash_message' => 'Cập nhật thành công'
        ]);
    }

    #=============End System Manager============#    




    #=============Page Manager============#    

    public function page_list()
    {
        $page = Page::get();
        return view('back.page.list', compact('page'));
    }

    public function page_edit(Request $request, $id)
    {
        $page = Page::where('RowID', $id)->get()->first();
        return view('back.page.edit', compact('page'));
    }

    public function page_edit_post(Request $request, $id)
    {
        if (empty($request->name) || $request->status == '') {
            return redirect('admin/page/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'name' => $request->name,
            'Alias' => $request->Alias,
            'status' => $request->status,
            'sort' => $request->sort,
            'font' => $request->font,
            'MetaTitle' => $request->MetaTitle,
            'MetaDescription' => $request->MetaDescription,
            'MetaKeyword' => $request->MetaKeyword,
            'Description' => $request->Description,
        ];
        $flag = Page::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/page/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/page/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }

    public function page_delete(Request $request, $id)
    {
        $user = Page::find($id);
        $flag = $user->delete();

        if ($flag) {
            return redirect('admin/page/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá trang thành công']);
        } else {
            return redirect('admin/page/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá trang']);
        }
    }

    public function page_add()
    {
        return view('back.page.add');
    }

    public function page_add_post(Request $request)
    {
        if (empty($request->name) || $request->sort == 0) {
            return redirect('admin/page/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $page = new Page;
        $page->Name = $request->name;
        $page->Font = $request->font;
        $page->Status = $request->status;
        $page->Sort = $request->sort;

        $flag = $page->save();

        if ($flag == true) {
            return redirect('admin/page/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm trang thành công']);
        } else {
            return redirect('admin/page/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm trang']);
        }
    }
    #=============End Page Manager============#    



    #=============Social Manager============#    
    public function social_list()
    {
        $social = Social::get();
        return view('back.social.list', compact('social'));
    }

    public function social_add()
    {
        return view('back.social.add');
    }

    public function social_add_post(Request $request)
    {
        if (empty($request->name) || $request->sort == 0) {
            return redirect('admin/social/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $social = new Social;
        $social->Name = $request->name;
        $social->Font = $request->font;
        $social->Alias = $request->alias;
        $social->Status = $request->status;
        $social->Sort = $request->sort;

        $flag = $social->save();

        if ($flag == true) {
            return redirect('admin/social/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm mạng xã hội thành công']);
        } else {
            return redirect('admin/social/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm mạng xã hội']);
        }
    }

    public function social_delete(Request $request, $id)
    {
        $social = Social::find($id);
        $flag = $social->delete();

        if ($flag) {
            return redirect('admin/social/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá mạng xã hội thành công']);
        } else {
            return redirect('admin/social/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá mạng xã hội']);
        }
    }

    public function social_edit(Request $request, $id)
    {
        $social = Social::where('RowID', $id)->get()->first();
        return view('back.social.edit', compact('social'));
    }

    public function social_edit_post(Request $request, $id)
    {
        if (empty($request->name) || $request->status == '') {
            return redirect('admin/social/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'name' => $request->name,
            'Alias' => $request->alias,
            'status' => $request->status,
            'sort' => $request->sort,
            'font' => $request->font
        ];
        $flag = Social::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/social/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/social/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }
    #=============End Social Manager============#    



    #=============Newsletter Manager============#    

    public function newsletter_list()
    {
        $newsletter = NewsLetter::get();
        return view('back.newsletter.list', compact('newsletter'));
    }

    public function newsletter_edit(Request $request, $id)
    {
        $newsletter = NewsLetter::where('RowID', $id)->get()->first();
        return view('back.newsletter.edit', compact('newsletter'));
    }

    public function newsletter_edit_post(Request $request, $id)
    {
        if (empty($request->name) || $request->status == '') {
            return redirect('admin/newsletter/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'Email' => $request->name,
            'Status' => $request->status,
        ];
        $flag = NewsLetter::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/newsletter/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/newsletter/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }

    public function newsletter_delete(Request $request, $id)
    {
        $newsletter = NewsLetter::find($id);
        $flag = $newsletter->delete();

        if ($flag) {
            return redirect('admin/newsletter/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá email thành công']);
        } else {
            return redirect('admin/newsletter/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá email']);
        }
    }

    public function newsletter_add()
    {
        return view('back.newsletter.add');
    }

    public function newsletter_add_post(Request $request)
    {
        if (empty($request->name)) {
            return redirect('admin/newsletter/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $newsletter = new NewsLetter;
        $newsletter->Email = $request->name;
        $flag = $newsletter->save();

        if ($flag == true) {
            return redirect('admin/newsletter/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm email thành công']);
        } else {
            return redirect('admin/newsletter/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm email']);
        }
    }
    #=============End Newsletter Manager============#    




    #=============Contact Manager============#    

    public function contact_list()
    {
        $contact = Contact::orderBy('RowID', 'DESC')->get();
        return view('back.contact.list', compact('contact'));
    }

    public function contact_edit(Request $request, $id)
    {
        $contact = Contact::where('RowID', $id)->get()->first();
        return view('back.contact.edit', compact('contact'));
    }

    public function contact_edit_post(Request $request, $id)
    {
        if (empty($request->name) || $request->status == '' || empty($request->email) || empty($request->phone) || empty($request->message)) {
            return redirect('admin/contact/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'Name' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
            'Message' => $request->message,
            'isViews' => $request->status,
        ];
        $flag = Contact::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/contact/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/contact/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }

    public function contact_delete(Request $request, $id)
    {
        $contact = Contact::find($id);
        $flag = $contact->delete();

        if ($flag) {
            return redirect('admin/contact/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá message thành công']);
        } else {
            return redirect('admin/contact/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá message']);
        }
    }

    public function contact_add()
    {
        return view('back.contact.add');
    }

    public function contact_add_post(Request $request)
    {
        if (empty($request->name)) {
            return redirect('admin/contact/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $contact = new Contact;
        $contact->Email = $request->name;
        $flag = $contact->save();

        if ($flag == true) {
            return redirect('admin/contact/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm message thành công']);
        } else {
            return redirect('admin/contact/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm message']);
        }
    }
    #=============End Contact Manager============#  




    #=============Category Manager============#  
    public function news_cat_list()
    {
        $news_cat = NewsCategory::get();
        return view('back.news_cat.list', compact('news_cat'));
    }

    public function news_cat_edit(Request $request, $id)
    {
        $news_cat = NewsCategory::where('RowID', $id)->get()->first();
        return view('back.news_cat.edit', compact('news_cat'));
    }

    public function news_cat_edit_post(Request $request, $id)
    {
        if (empty($request->name) || $request->status == '') {
            return redirect('admin/news_cat/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'Name' => $request->name,
            'Status' => $request->status,
        ];
        $flag = NewsCategory::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/news_cat/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/news_cat/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }

    public function news_cat_delete(Request $request, $id)
    {
        $news_cat = NewsCategory::find($id);
        $flag = $news_cat->delete();

        if ($flag) {
            return redirect('admin/news_cat/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá danh mục thành công']);
        } else {
            return redirect('admin/news_cat/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá danh mục']);
        }
    }

    public function news_cat_add()
    {
        return view('back.news_cat.add');
    }

    public function news_cat_add_post(Request $request)
    {
        if (empty($request->name) || $request->status == '') {
            return redirect('admin/news_cat/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $news_cat = new NewsCategory;
        $news_cat->Name = $request->name;
        $flag = $news_cat->save();

        if ($flag == true) {
            return redirect('admin/news_cat/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm danh mục thành công']);
        } else {
            return redirect('admin/news_cat/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm danh mục']);
        }
    }
    #=============End Category Manager============#  




    #=============News Manager============#  
    public function news_list()
    {

        $news = DB::table('news as a')->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')->selectRaw('a.*,b.Name as CategoryName')->orderBy('a.RowID', 'DESC')->get();
        return view('back.news.list', compact('news'));
    }

    public function news_edit(Request $request, $id)
    {
        $category = NewsCategory::where('Status', 1)->get();
        $news = News::where('RowID', $id)->get()->first();
        return view('back.news.edit', compact('news', 'category'));
    }

    public function news_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'Description' => 'required',
            'Images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/news/edit/' . $id)
                ->withErrors($validator)
                ->withInput()
                ->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng kiểm tra lại các trường.']);
        }

        $oldNews = News::find($id);
        if ($oldNews && !empty($oldNews->Images) && $request->file('Images') != NULL) {
            $oldImagePath = 'resources/images/news/' . $oldNews->Images;

            // Kiểm tra xem hình ảnh cũ có tồn tại không
            if (file_exists($oldImagePath)) {
                // Xoá hình ảnh cũ
                unlink($oldImagePath);
            }
        }

        // Tạo mới đối tượng News và gán giá trị từ request
        $datas = [
            'Name' => $request->Name,
            'Alias' => $request->Alias,
            'RowIDCat' => $request->CategoryName,
            'Status' => $request->Status,
            'MetaTitle' => $request->MetaTitle,
            'MetaDescription' => $request->MetaDescription,
            'MetaKeyword' => $request->MetaKeyword,
            'SmallDescription' => $request->SmallDescription,
            'Description' => $request->Description
        ];

        // Xử lý hình ảnh
        if ($request->hasFile('Images') && $request->file('Images') != NULL) {
            $file = $request->file('Images');

            // Tạo tên ngẫu nhiên cho hình ảnh
            $name = uniqid() . '-' . $file->getClientOriginalName();

            // Di chuyển hình ảnh đến thư mục lưu trữ
            $file->move('resources/images/news', $name);

            // Đường dẫn đầy đủ đến hình ảnh
            $imagePath = 'resources/images/news/' . $name;

            // Sử dụng Intervention Image để xử lý hình ảnh
            $img = Image::make($imagePath);
            $img->fit(208, 141);
            $img->save($imagePath);

            // Gán đường dẫn lưu trữ hình ảnh vào thuộc tính Image của đối tượng News
            $datas['Images'] =  $name;
        }

        // Lưu đối tượng News
        $flag = News::where('RowID', $id)->update($datas);

        // Kiểm tra và chuyển hướng
        if ($flag) {
            return redirect('admin/news/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm tin tức thành công']);
        } else {
            return redirect('admin/news/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm tin tức']);
        }
    }

    public function news_delete(Request $request, $id)
    {
        $news = News::find($id);
        $flag = $news->delete();

        if ($flag) {
            return redirect('admin/news/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá tin tức thành công']);
        } else {
            return redirect('admin/news/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá tin tức']);
        }
    }

    public function news_add()
    {
        $category = NewsCategory::where('Status', 1)->get();
        return view('back.news.add', compact('category'));
    }

    public function news_add_post(Request $request)
    {
        // Kiểm tra validation
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'Description' => 'required',
            'Images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/news/add')
                ->withErrors($validator)
                ->withInput()
                ->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng kiểm tra lại các trường.']);
        }

        // Tạo mới đối tượng News và gán giá trị từ request
        $news = new News;
        $news->Name = $request->Name;
        $news->Alias = $request->Alias;
        $news->RowIDCat = $request->CategoryName;
        $news->Status = $request->Status;
        $news->MetaTitle = $request->MetaTitle;
        $news->MetaDescription = $request->MetaDescription;
        $news->MetaKeyword = $request->MetaKeyword;
        $news->SmallDescription = $request->SmallDescription;
        $news->Description = $request->Description;

        // Xử lý hình ảnh
        if ($request->hasFile('Images')) {
            $file = $request->file('Images');

            // Tạo tên ngẫu nhiên cho hình ảnh
            $name = uniqid() . '-' . $file->getClientOriginalName();

            // Di chuyển hình ảnh đến thư mục lưu trữ
            $file->move('resources/images/news', $name);

            // Đường dẫn đầy đủ đến hình ảnh
            $imagePath = 'resources/images/news/' . $name;

            // Sử dụng Intervention Image để xử lý hình ảnh
            $img = Image::make($imagePath);
            $img->fit(208, 141);
            $img->save($imagePath);

            // Gán đường dẫn lưu trữ hình ảnh vào thuộc tính Image của đối tượng News
            $news->Images = $name;
        }

        // Lưu đối tượng News
        $flag = $news->save();

        // Kiểm tra và chuyển hướng
        if ($flag) {
            return redirect('admin/news/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm tin tức thành công']);
        } else {
            return redirect('admin/news/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm tin tức']);
        }
    }

    #=============End News Manager============#  


    #=============Slideshow Manager============#  
    public function slider_list()
    {
        $slider = Slider::get();
        return view('back.slider.list', compact('slider'));
    }

    public function slider_edit(Request $request, $id)
    {
        $category = Slider::where('Status', 1)->get();
        $slider = Slider::where('RowID', $id)->get()->first();
        return view('back.slider.edit', compact('slider'));
    }

    public function slider_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'Images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/slider/edit/' . $id)
                ->withErrors($validator)
                ->withInput()
                ->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng kiểm tra lại các trường.']);
        }

        $oldslider = Slider::find($id);
        if ($oldslider && !empty($oldslider->Images)) {
            $oldImagePath = 'resources/images/sliders/' . $oldslider->Images;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $datas = [
            'Name' => $request->Name,
            'Status' => $request->Status,
            'Images' => $request->Images,
            'Sort' => $request->Sort,
        ];

        if ($request->hasFile('Images')) {
            $file = $request->file('Images');

            $name = uniqid() . '-' . $file->getClientOriginalName();

            $file->move('resources/images/sliders/', $name);

            $imagePath = 'resources/images/sliders/' . $name;

            $img = Image::make($imagePath);
            $img->save($imagePath);

            $datas['Images'] =  $name;
        }

        $flag = Slider::where('RowID', $id)->update($datas);

        if ($flag) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success', 'flash_message' => 'Sửa thành công']);
        } else {
            return redirect('admin/slider/list')->with(['flash_level' => 'danger', 'flash_message' => 'Sửa thất bại']);
        }
    }

    public function slider_delete(Request $request, $id)
    {
        $slider = Slider::find($id);
        $flag = $slider->delete();

        if ($flag) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá thành công']);
        } else {
            return redirect('admin/slider/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xoá thất bại']);
        }
    }

    public function slider_add()
    {
        $category = Slider::where('Status', 1)->get();
        return view('back.slider.add', compact('category'));
    }

    public function slider_add_post(Request $request)
    {
        // Kiểm tra validation
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'Images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/slider/add')
                ->withErrors($validator)
                ->withInput()
                ->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng kiểm tra lại các trường.']);
        }

        $slider = new Slider;
        $slider->Name = $request->Name;
        $slider->Sort = $request->Sort;
        $slider->Status = $request->SmallDescription;

        if ($request->hasFile('Images')) {
            $file = $request->file('Images');
            $name = uniqid() . '-' . $file->getClientOriginalName();
            $file->move('resources/images/sliders/', $name);
            $imagePath = 'resources/images/sliders/' . $name;
            $img = Image::make($imagePath);
            $img->save($imagePath);

            $slider->Images = $name;
        }

        $flag = $slider->save();

        if ($flag) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêmthành công']);
        } else {
            return redirect('admin/slider/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm']);
        }
    }

    #=============End SlideShow Manager============#  

    #=============contact_info Manager============#    

    public function contact_info_list()
    {
        $contact_info = ContactInfo::get();
        return view('back.contact_info.list', compact('contact_info'));
    }

    public function contact_info_edit(Request $request, $id)
    {
        $contact_info = ContactInfo::where('RowID', $id)->get()->first();
        return view('back.contact_info.edit', compact('contact_info'));
    }

    public function contact_info_edit_post(Request $request, $id)
    {
        if (empty($request->Name) || $request->Status == '' || empty($request->Description) || empty($request->Font)) {
            return redirect('admin/contact_info/edit/' . $id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $data = [
            'Name' => $request->Name,
            'Font' => $request->Font,
            'Status' => $request->Status,
            'Description' => $request->Description,
        ];
        $flag = ContactInfo::where('RowID', $id)->update($data);
        if ($flag) {
            return redirect('admin/contact_info/list')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thông tin thành công']);
        } else {
            return redirect('admin/contact_info/list')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thông tin thất bại']);
        }
    }

    public function contact_info_delete(Request $request, $id)
    {
        $user = ContactInfo::find($id);
        $flag = $user->delete();

        if ($flag) {
            return redirect('admin/contact_info/list')->with(['flash_level' => 'success', 'flash_message' => 'Xoá trang thành công']);
        } else {
            return redirect('admin/contact_info/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xoá trang']);
        }
    }

    public function contact_info_add()
    {
        return view('back.contact_info.add');
    }

    public function contact_info_add_post(Request $request)
    {
        if (empty($request->name) || $request->sort == 0) {
            return redirect('admin/contact_info/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có *']);
        }

        $contact_info = new ContactInfo;
        $contact_info->Name = $request->name;
        $contact_info->Font = $request->font;
        $contact_info->Status = $request->status;
        $contact_info->Sort = $request->sort;

        $flag = $contact_info->save();

        if ($flag == true) {
            return redirect('admin/contact_info/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm trang thành công']);
        } else {
            return redirect('admin/contact_info/add')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm trang']);
        }
    }
    #=============End Page Manager============#    

    #=============Mail Manager============#  
    public function sendNotice(Request $request)
    {
        $RowID = intval($request->RowID);
        if ($RowID) {
            $news = News::where('RowID', $RowID)->first();
            $listMail = NewsLetter::where('Status', 1)->get();
            foreach ($listMail as $mail) {
                $this->sendMail($mail->Email, $news);
            }
            return true;
        }
    }

    public function reply_contact(Request $request, $id)
    {
        $contact = Contact::where('RowID', $id)->first();
        return view('back.reply.replyContact', compact('contact'));
    }

    public function reply_contact_post(Request $request, $id)
    {
        $contactInfo =  Contact::where('RowID', $id)->first();
        $replyContent = $request->replyContent;
        $email = $contactInfo->Email;
        $flag = Mail::to($email)->send(new ReplyMail($contactInfo, $replyContent));
        if ($flag == true) {
            $contactInfo->isRep = 1;
            $contactInfo->update();
            return redirect('admin/contact/list')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thông tin tài khoản thành công']);
        } else {
            return redirect('admin/contact/list')->with(['flash_level' => 'danger', 'flash_message' => 'Chỉnh sửa tài khoản không thành công']);
        }
    }

    public function sendMail($email, $news)
    {
        Mail::to($email)->send(new NoticeMail($news));
    }
    #=============Mail Manager============#  
}
