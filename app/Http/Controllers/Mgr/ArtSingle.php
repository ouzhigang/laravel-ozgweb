<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class ArtSingle extends Base {
	
	public function get(Request $request) {
		$id = $request->input("id", 0);
		$data = \App\Model\ArtSingle::getById($id);
		return response()->json($data);
	}
	
	public function update(Request $request) {
		$id = $request->input("id", 0);
		$content = $request->input("content", "");
		$data = [
			"content" => $content
		];
		$res = \App\Model\ArtSingle::saveData($data, $id);
		
		return response()->json($res);
	}
	
}
