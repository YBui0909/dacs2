<?php

namespace App\Http\Controllers;

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
use App\Models\Comment;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Psy\Readline\Hoa\Console;

use function Laravel\Prompts\alert;

class FrontController extends Controller
{
    public function __construct()
    {
        @session_start();

        # logo
        $logo = System::select('Description')->where('Code', 'logo')->first();
        view()->share('logo', $logo);

        # favicon
        $favicon = System::select('Description')->where('Code', 'favicon')->first();
        view()->share('favicon', $favicon);

        # social
        $social = Social::where('Status', 1)
            ->selectRaw('Name, Font, Alias')
            ->orderBy('Sort', 'ASC')
            ->get();
        view()->share('social', $social);

        $page = Page::where('Status', 1)
            ->selectRaw('Name, Font, Alias')
            ->orderBy('Sort', 'ASC')
            ->get();
        view()->share('page', $page);

        $cat = NewsCategory::where('Status', 1)->get();
        view()->share('cat', $cat);

        $copyright = System::select('Description')->where('Code', 'copyright')->first();
        view()->share('copyright', $copyright);

        $news = News::where('Status', 1)->orderBy('RowID', 'DESC')->get();
        view()->share('news', $news);
    }

    public function home()
    {
        $news = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->select('a.*', 'b.Name as CategoryName')
            ->orderBy('a.RowID', 'DESC')
            ->limit(6)
            ->get();

        $newsHard = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->select('a.*', 'b.Name as CategoryName')
            ->where('a.RowIDCat', 1)
            ->orderBy('a.RowID', 'DESC')
            ->limit(4)
            ->get();

        $newsSoft = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->select('a.*', 'b.Name as CategoryName')
            ->where('a.RowIDCat', 2)
            ->orderBy('a.RowID', 'DESC')
            ->limit(4)
            ->get();

        $newsTip = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->select('a.*', 'b.Name as CategoryName')
            ->where('a.RowIDCat', 4)
            ->orderBy('a.RowID', 'DESC')
            ->limit(4)
            ->get();

        $slider = DB::table('slider')->limit(3)->get();

        return view('front.home.home', compact('news', 'newsSoft', 'newsHard', 'newsTip', 'slider'));
    }

    #subEmail
    public function subEmail(Request $request)
    {
        if ($request->email != '') {
            $newLetter = NewsLetter::where('Email', $request->email)->get();
            if (isset($newLetter) && count($newLetter) > 0) {
                return 'exit email';
            } else {
                $newLetter = new NewsLetter;
                $newLetter->Email = $request->email;
                $newLetter->save();
                return 'Đăng ký nhận tin mới thành công';
            }
        }
    }

    #contact page
    public function contact()
    {
        $contactInfo = ContactInfo::limit(3)->get();
        return view('front.contact.contact', compact('contactInfo'));
    }

    public function messageContact(Request $request)
    {
        if ($request->email != '' || $request->name != '' || $request->message != '') {
            $messageContact = new Contact;
            $messageContact->email = $request->email;
            $messageContact->name = $request->name;
            $messageContact->message = $request->message;
            $messageContact->phone = $request->phone;
            $messageContact->save();
            return 'Gửi tin thành công';
        } else {
            return 'Vui lòng nhập đầy đủ thông tin';
        }
    }

    public function updateViews(Request $request)
    {
        $RowID = intval($request->RowID);
        $view = News::where('RowID', $RowID)->first();
        $view->Views += 1;
        $view->update();
    }

    public function search(Request $request)
    {
        $searchInfo = Page::where('Status', 0)->where('Alias', 'tim-kiem')->first();
        $keyword = $request->input('keyword');
        $slugKeyword = Str::slug($keyword);
        $searchList = News::where('Status', 1)->where('Alias', 'LIKE', '%' . $slugKeyword . '%')->orWhere('MetaKeyword', 'LIKE', '%' . $keyword . '%')->orWhere('Description', 'LIKE', '%' . $keyword . '%')->orWhere('Name', 'LIKE', '%' . $keyword . '%')->paginate(10);
        return view('front.search.search', compact('searchList', 'searchInfo'));
    }

    public function about()
    {
        $contactInfo = ContactInfo::limit(3)->get();
        $pageInfo = Page::where('Alias', 've-chung-toi')->first();
        return view('front.about.about', compact('contactInfo', 'pageInfo'));
    }

    public function slug($slug)
    {
        $newsCat = NewsCategory::where('Status', 1)->where('Alias', $slug)->first();
        if (isset($newsCat) && $newsCat != NULL) {
            $listNews = DB::table('news as a')
                ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
                ->selectRaw('a.Name, a.Alias, a.SmallDescription, a.Images, a.RowID')
                ->orderBy('a.RowID', 'DESC')
                ->where('a.Status', 1)
                ->where('b.Alias', $slug)
                ->paginate(6);
            $catName = NewsCategory::where('Alias', $slug)->first();

            return view('front.news.cat', compact('listNews', 'catName'));
        }
    }

    public function slugHtml(Request $request, $slug)
    {
        $detailNews = News::where('Alias', $slug)->first();
        if (!$detailNews) {
            abort(404);
        }

        $newsName = News::where('Alias', $slug)->value('Name');

        //Lấy comment của bài viết
        $idNews = $detailNews->RowID;
        $comment_LV1 = Comment::where('News_ID', $idNews)->where('Level', 1)->orderBy('RowID', 'DESC')->get();
        $comment_LV2 = Comment::where('News_ID', $idNews)->Where('Level', 2)->get();
        $comment_LV3 = Comment::where('News_ID', $idNews)->Where('Level', 3)->get();

        return view('front.news.detail', compact('detailNews', 'newsName', 'comment_LV1', 'comment_LV2', 'comment_LV3'));
    }

    public function comment(Request $request)
    {
        $rowID = $request->input('RowID');
        $content = $request->input('Contents');
        $name = $request->input('Name');

        // Validate input data
        if (empty($content) || empty($name)) {
            return response()->json(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
        }

        $comment = new Comment;
        $comment->News_ID = $rowID;
        $comment->Name = $name;
        $comment->Contents = $content;

        $flag = $comment->save();

        if ($flag) {
            return response()->json(['success' => true, 'message' => 'Bình luận thành công.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi lưu bình luận.']);
        }
    }
    public function replyComment(Request $request)
    {
        $newID = $request->input('NewID');
        $replyID = $request->input('ReplyID');
        $level = $request->input('Level');
        $content = $request->input('Contents');
        $name = $request->input('Name');

        // Validate input data
        if (empty($content) || empty($name)) {
            return response()->json(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
        }

        $comment = new Comment;
        $comment->News_ID = $newID;
        $comment->Reply_ID = $replyID;
        $comment->Level = $level;
        $comment->Name = $name;
        $comment->Contents = $content;

        $flag = $comment->save();

        if ($flag) {
            return response()->json(['success' => true, 'message' => 'Bình luận thành công.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi lưu bình luận.']);
        }
    }
}
