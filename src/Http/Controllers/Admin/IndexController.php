<?php
namespace Newelement\PackageName\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        /*
        if( $request->ajax() ){
            return response()->json($data);
        } else {
            return view('packagename::admin.dashboard', $data);
        }
        */
    }
}
