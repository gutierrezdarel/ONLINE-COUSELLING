<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class ChartDataController extends Controller
{

	/* function getAllMonths(){

		$monthArray = array();
		$postsDates = Post::orderBy('created_at', 'asc')->pluck( 'created_at' );
		$postsDates = json_decode( $postsDates );
		
		if ($postsDates) {
			foreach ( $postsDates as $unformattedDate ) {
				
				$date = new \DateTime($unformattedDate);
				$monthNo = $date->format( 'm' );
				$monthName = $date->format( 'M' );
				$monthArray[ $monthNo ] = $monthName;
			}
		}
		return $monthArray;
	}

	function getMonthlyPostCount($month) {
		$monthly_post_count = Post::whereMonth( 'created_at', $month )->get()->count();
		return $monthly_post_count;
	}

	function getMonthlyPostData() {

		$monthlyPostCountArray = array();
		$monthArray = $this->getAllMonths();

		$monthNameArray = array();
		if ( ! empty( $monthArray ) ) {
			foreach ( $monthArray as $monthNo => $monthName ){
				$monthlyPostCount = $this->getMonthlyPostCount($monthNo);
				array_push( $monthlyPostCountArray, $monthlyPostCount );
				array_push( $monthNameArray, $monthName );
			}
		}

		$max_no = max( $monthlyPostCountArray );
		$max = round(( $max_no + 10/2 ) / 10 ) * 10;
		$monthPostsDataArray = array(
			'months' => $monthNameArray,
			'post_count_data' => $monthlyPostCountArray,
			'max' => $max,
		);

		return $monthPostsDataArray;

    } */

	public function getPosts(){
		
		$data = array(
			'personals' => Post::where('category_id',1)->count(),
			'academics' => Post::where('category_id',2)->count(),
			'careers' => Post::where('category_id',3)->count(),
		);

		return response()->json($data);
	}


}
