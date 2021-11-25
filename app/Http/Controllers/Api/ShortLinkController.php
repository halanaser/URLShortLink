<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        $shortLinks = $user->ShortLink() ->with('user')->paginate();
   
        return $shortLinks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
         ]);
         //get title
         $page = file_get_contents( $request->link);
         $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
         $user = Auth::guard('sanctum')->user();
         $input['user_id']=$user->id;
         $input['link'] = $request->link;
         $input['code'] = Str::random(6);
         $input['titles'] = $title;

         $ShortLink =ShortLink::create($input);
          
         return response($ShortLink, 201);
    }


}
