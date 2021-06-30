<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

global $head, $body, $end;
$head = '<html><head>';
$body = '</head><body>';
$end = '</body></html>';

function tag($tag, $txt) {
    return "<{$tag}>". $txt ."</{$tag}>";
}

class HelloController extends Controller
{
    public function index (Request $request) {
        if(isset($request->id)){
            $param = ['id' => $request->id];
            $items = DB::select('select * from people where id = :id', $param);
        }else{
            $items = DB::select('select * from people');
        }
        return view('hello.index', ['items'=> $items]);
    }

    public function post (HelloRequest $request) {
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }

    public function add (Request $request){
        return view('hello.add');
    }

    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values(:name, :mail, :age)',
        $param);
        return redirect('../public/hello');
    }

    public function edit(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id= :id',$param);
        return view ('hello.edit', ['form' => $item[0]]);
    }

    public function update(Request $request) {
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail=:mail, age=:age where id= :id', 
        $param);

        return redirect('../public/hello');
    }

    public function del(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id= :id',$param);
        return view ('hello.delete', ['form' => $item[0]]);
    }

    public function remove(Request $request) {
        $param = ['id' => $request->id,];
        DB::delete('delete from people where id= :id', $param);
        return redirect('../public/hello');
    }
}