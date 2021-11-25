<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use hisorange\BrowserDetect\Parser as Browser;
use App\Models\ShortLink;
use App\Models\Detail;
class ShortLinkController extends Controller
{
    //
    public function index()
    {
        $user=Auth::user();
        $shortLinks = ShortLink::where('user_id', '=', $user->id )
       ->paginate();
   
        // dd($shortLinks);
        return view('dashboard', compact('shortLinks'));
    }

  public function store(Request $request)
    {
        
        $request->validate([
           'link' => 'required|url'
        ]);
      
        $page = file_get_contents( $request->link);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
      
        $input['user_id']=Auth::user()->id;
        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $input['titles'] = $title;
    

        ShortLink::create($input);
  
      
        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
             
    }

    public function shortenLink($code)
    {   
        $user_Agent=Browser::browserName();
        $ipaddress= request()->ip();
       
     //  $user_Agent=$request->header('user_Agent');
        // $ipaddress=$request()->ip();
        
    
        $find = ShortLink::where('code', $code)->first();
        $find->clicks = $find->clicks + 1;
        $find->save();
        $id= $find->id;
    //    dd( $id);
         $New= Detail::create([
            'code_id'=> $id,
            'user_agent'=>$user_Agent,
            'ip_address'=> $ipaddress,
        ]);
        $New->save();

       // var_dump($find);
     
       return redirect($find->link);
    }

 
public function  detail($id)
{ 
    $user=Auth::user();
    
    $shortLinks = ShortLink::where('user_id', '=', $user->id )
    ->where('id', '=', $id )
   ->paginate();
//    dd($shortLinks);
    $Details = Detail::where('code_id', '=', $id )
   ->paginate();
   return view('details',  [
    'Details' => $Details,
    'shortLinks'=>$shortLinks,
]);

}
}