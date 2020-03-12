<?php

namespace App\Http\Controllers;

use App\Http\DTO\BoardRequestDto;
use App\Service\BoardServiceImp;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


class ChatController extends Controller
{

    public function __construct()
    {
    }

    /**
     * @return string :: view render
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index()
    {

    }

    public function entrance(Request $req)
    {
        $aReturn = [
            "token"       => csrf_token(), // 세션 아이디를 달고 다니자
            "feild_token" => csrf_field(),
            "nickName"    => $req->session()->get('nickName', 'unknown') // 유저 닉네임으로..
        ];

        return $this->view("/chat/chat.entrance.twig", $aReturn);
    }


    public function setNickName(Request $req)
    {
        $reqNick      = $req->input("nickName");
        $profilePhoto = $req->input("user_profile");

        $aReturn = [
            "code"   => 4,
            "status" => false
        ];

        if ($req->session()->has("nickName")){
            $req->session()->forget("nickName");
        }

        if ($req->session()->has("user_profile")) {
            $req->session()->forget("user_profile");
        }

        $req->session()->put("nickName",$reqNick);
        $req->session()->put("user_profile",$profilePhoto);

        if ($req->session()->has("nickName")) {
            $aReturn = [
                "code"   => 1,
                "status" => $req->session()->has("nickName"),
                "toUrl"    => "/chat/chatRoom"
            ];
        }

        return collect($aReturn)->toJson();
    }

    public function chatRoom(Request $req)
    {
        // 닉네임 없으면 메인으로?
        if (!$req->session()->has("nickName")) {

        }

        $aReturn = [
            "token"       => csrf_token(), // 세션 아이디를 달고 다니자
            "feild_token" => csrf_field(),
            "nickName"      => $req->session()->get('nickName', 'unknown'), // 유저 닉네임으로..
            "user_profile"      => $req->session()->get('user_profile', 'http://image.club5678.com/imgs/mobile/q_call_plus/img/thum_avatar2-f.png') // 프로필 사진 설정
        ];

        return $this->view("/chat/chat.msg.box.twig", $aReturn);
    }

    public function getTempFile(Request $request){
        $dir    = sys_get_temp_dir();
        $files1 = scandir($dir);
        //$name = exec('ls -ltr /tmp | tail -1 | awk \'{ print $9 }\'');
        $name = exec('ls -ltr /tmp | tail -1 ');
        echo collect([($name)]);
            exit;
        ;

    }

    /**
     * @param $viewFile
     * @param $data
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function view(String $viewFile, Array $data = [])
    {
        /**
         *@var $twig \Twig\Environment
         */
        $twig = resolve('Twig');
        return $twig->render($viewFile, $data);
    }
}
