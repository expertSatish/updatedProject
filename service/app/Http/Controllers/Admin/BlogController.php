<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Image;
use Helper;
use Illuminate\Support\Facades\DB;
use PDF;
use App;
use App\BlogComment;
use Illuminate\Support\Str;



class BlogController extends Controller{

    public function __construct(){
        $this->middleware('auth.admin');
    }

	public function index(){
		return view('control-panel.blog.blog-management');
	}

	public function blog_post(){
		$categories = DB::table('blog_post')->orderBy('post_sort', 'desc')->get();
		return view('control-panel.blog.post-management')->with(array('categories' => $categories));
	}

	public function blog_category(){
		$categories = DB::table('blog_category')->orderBy('cate_sort', 'desc')->get();
		return view('control-panel.blog.category-management')->with(array('categories' => $categories));
	}
	public function add_category(Request $request){
		$count = DB::table('blog_category')->select('cate_id')->get()->count();
		$name = $request->input('name');
		$type = $request->input('type');
		$description = $request->input('description');
		$meta_title = $request->input('meta_title');
		$meta_description = $request->input('meta_description');
		$meta_keywords = $request->input('meta_keywords');
		$count = $count + 1;



		/*----------------------Slug Start-------------------------------*/



		$table = 'blog_category';      /*------------Write table name---------------*/

		$field = 'cate_alias';          /*------------Write field name---------------*/

		$slug = $name;  /*------------Write title for slug-----------*/

		$slug = Str::slug($name, "-");

		$key = NULL;

		$value = NULL;



		$i = 0;

		$params = array();

		$params[$field] = $slug;



		if ($key) $params["$key !="] = $value;



		while (DB::table($table)->where($params)->get()->count()) {

			if (!preg_match('/-{1}[0-9]+$/', $slug))

				$slug .= '-' . ++$i;

			else

				$slug = preg_replace('/[0-9]+$/', ++$i, $slug);

			$params[$field] = $slug;
		}



		$alias = $slug;



		/*----------------------Slug End-------------------------------*/





		DB::table('blog_category')->insert([

			[

				'type' => $type,

				'description' => $description,

				'cate_name' => $name,

				'cate_alias' => $alias,

				'cate_sort' => $count,

				'meta_title' => $meta_title,

				'meta_description' => $meta_description,

				'meta_keywords' => $meta_keywords,

			]

		]);



		return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
	}
	public function category_status($status, $id){
		DB::table('blog_category')
			->where('cate_id', $id)
			->update(['cate_status' => $status]);
		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}
	public function edit_blog($id){
		$categories = DB::table('blog_category')->where('cate_id', $id)->get();
		return view('control-panel.blog.edit-category')->with(array('categories' => $categories));
	}



	public function update_category(Request $request, $category_id)
	{





		$name = $request->input('name');

		$alias = $request->input('alias');

		$old_alias = $request->input('old_alias');

		$meta_title = $request->input('meta_title');

		$meta_description = $request->input('meta_description');

		$meta_keywords = $request->input('meta_keywords');



		$type = $request->input('type');

		$description = $request->input('description');





		/*----------------------Slug Start-------------------------------*/





		$table = 'blog_category';      /*------------Write table name---------------*/

		$field = 'cate_alias';          /*------------Write field name---------------*/

		$slug = $alias;  /*------------Write title for slug-----------*/

		$slug = Str::slug($slug, "-");

		$key = NULL;

		$value = NULL;



		$i = 0;

		$params = array();

		$params[$field] = $slug;



		if ($key) $params["$key !="] = $value;

		if ($alias != $old_alias) {

			while (DB::table($table)->where($params)->get()->count()) {

				if (!preg_match('/-{1}[0-9]+$/', $slug))

					$slug .= '-' . ++$i;

				else

					$slug = preg_replace('/[0-9]+$/', ++$i, $slug);

				$params[$field] = $slug;
			}



			$alias2 = $slug;
		} else {

			$alias2 = $alias;
		}



		/*----------------------Slug End-------------------------------*/





		DB::table('blog_category')

			->where('cate_id', $category_id)

			->update([

				'type' => $type,

				'description' => $description,

				'cate_name' => $name,

				'cate_alias' => $alias,

				'meta_title' => $meta_title,

				'meta_description' => $meta_description,

				'meta_keywords' => $meta_keywords,

			]);



		return redirect(url('/control-panel/blog-category'))->with(array('success_msg' => Helper::saveMSG()));
	}





	public function cat_change_sequence(Request $request)
	{

		$sequence_arr = $request->input('sequence');

		foreach ($sequence_arr as $cat_id => $sequence) {

			DB::table('blog_category')

				->where('cate_id', $cat_id)

				->update([

					'cate_sort' => $sequence,



				]);
		}

		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}


	public function blog_home_status(Request $request)
	{
		$blog = DB::table('blog_post')->where('post_id', $request->id)->first();
		$status = $blog->home_status;
		if ($status == 0) {
			DB::table('blog_post')->where('post_id', $request->id)
				->update([
					'home_status' => 1
				]);
		} else {
			DB::table('blog_post')->where('post_id', $request->id)
				->update([
					'home_status' => 0
				]);
		}
		return redirect()->back()->with(['success_msg' => 'Home Status Change Successfully']);
	}



	public function category_delete($id)
	{

		DB::table('blog_category')->where('cate_id', $id)->delete();

		return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
	}





	public function add_post()
	{

		return view('control-panel.blog.add-blog-post');
	}



	public function post_add(Request $request)
	{

		$name = $request->input('name');

		$description = $request->input('description');

		$short_description = $request->input('short_description');

		$meta_title = $request->input('meta_title');

		$meta_description = $request->input('meta_description');

		$meta_keywords = $request->input('meta_keywords');

		$map_id = $request->input('map_id');

		$img_alt = $request->input('img_alt');

		$video = $request->input('video');

		$sequnce = DB::table('blog_post')->where('post_mapped_id', $map_id)->count();

		$type = $request->input('type');

		$tags = $request->input('tags');

		$post_date = $request->input('post_date');

		$map_package = $request->input('map_package');



		$Banner = $request->file('bannerimage');



		$pack = "";

		if (!empty($map_package)) {

			$sep = "";

			foreach ($map_package as $map_pack) {

				$pack .= $sep . $map_pack;

				$sep = "|";
			}
		}

		$sequnce = $sequnce + 1;





		$BannerImg = '';

		if (!empty($Banner)) {

			$extension = $Banner->getClientOriginalExtension(); // getting image extension

			$BannerImg = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

			$BannerPath = resource_path('/assets/uploads/post/banner/' . $BannerImg); // upload path thumbnailex

			Image::make($Banner->getRealPath())->resize(890, 500)->brightness(1)->save($BannerPath);
		}





		/*--------------------------upload image-----------------------------------*/

		if ($type == 1) {

			$brochureimg = $request->file('brochure');

			if ($brochureimg == "") {

				$brochure = "";
			} else {



				$destinationPath = resource_path('/assets/uploads/post/original/'); // upload path

				$extension = $brochureimg->getClientOriginalExtension(); // getting image extension

				$brochure = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

				$thumbnail = resource_path('/assets/uploads/post/thumb/' . $brochure); // upload path thumbnailex

				Image::make($brochureimg->getRealPath())->resize(500, 250)->brightness(1)->save($thumbnail);

				$brochureimg->move($destinationPath, $brochure); // uploading file to given path

			}
		}

		if ($type == 2) {

			$brochure = $video;
		}



		/*--------------------------upload image end-----------------------------------*/



		/*----------------------Slug Start-------------------------------*/

		$table = 'blog_post'; /*------------Write table name---------------*/

		$field = 'post_alias'; /*------------Write field name---------------*/

		$slug = $name; /*------------Write title for slug-----------*/

		$slug = Str::slug($slug, "-");

		$key = NULL;

		$value = NULL;

		$i = 0;

		$params = array();

		$params[$field] = $slug;

		if ($key) $params["$key !="] = $value;

		while (DB::table($table)->where($params)->get()->count()) {

			if (!preg_match('/-{1}[0-9]+$/', $slug)) $slug .= '-' . ++$i;

			else $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

			$params[$field] = $slug;
		}



		$alias = $slug;





		$GetCateType = DB::table('blog_category')->where('cate_id', $map_id)->first();



		$CateType = $GetCateType->type;





		$data = ['post_name' => $name, 'post_alias' => $alias, 'post_desc' => $description, 'post_short_desc' => $short_description, 'post_image' => $brochure,  'post_mapped_id' => $map_id, 'cate_type' => $CateType, 'meta_title' => $meta_title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'post_image_alt' => $img_alt, 'post_date' => date("Y-m-d", strtotime($post_date)), 'post_month' => date("F-Y", strtotime($post_date)), 'type' => $type, 'post_sort' => $sequnce, 'tags' => $tags, 'map_package' => $pack, 'banner_image' => $BannerImg];

		$insertID = DB::table('blog_post')->insert($data);





		if ($insertID) {

			return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
		} else {

			return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
		}
	}



	public function change_post_status($id, $status)
	{

		DB::table('blog_post')

			->where('post_id', $id)

			->update(['post_status' => $status]);



		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}





	public function change_top5_status($id, $status)
	{

		DB::table('blog_post')

			->where('post_id', $id)

			->update(['top5_status' => $status]);



		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}



	function change_Press_Room_status($id, $status)
	{

		DB::table('blog_post')

			->where('post_id', $id)

			->update(['press_room' => $status]);



		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}









	public function post_change_sequence(Request $request)
	{

		$sequence_arr = $request->input('sequence');

		foreach ($sequence_arr as $cat_id => $sequence) {

			if ($sequence == "") {

				$sequence = 0;
			}

			DB::table('blog_post')

				->where('post_id', $cat_id)

				->update(['post_sort' => $sequence]);
		}

		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}



	public function edit_post($id)
	{

		$post = DB::table('blog_post')->where('post_id', $id)->first();

		return view('control-panel.blog.edit-blog-post')->with(array('post' => $post));
	}





	public function post_update(Request $request, $id)
	{

		$name = $request->input('name');

		$description = $request->input('description');

		$short_description = $request->input('short_description');

		$meta_title = $request->input('meta_title');

		$meta_description = $request->input('meta_description');

		$meta_keywords = $request->input('meta_keywords');

		$map_id = $request->input('map_id');

		$img_alt = $request->input('img_alt');

		$video = $request->input('video');

		$old_image =  $request->input('old_image');

		$alias =  $request->input('post_alias');

		$old_alias =  $request->input('old_alias');

		$type = $request->input('type');

		$tags = $request->input('tags');

		$map_package = $request->input('map_package');



		$post_date = $request->input('post_date');



		$pack = "";



		$Banner = $request->file('Bannerimage');

		$PreBanner = $request->input('old_Bannerimage');



		$BannerImg = $PreBanner;



		if (!empty($Banner)) {

			$extension = $Banner->getClientOriginalExtension(); // getting image extension

			$BannerImg = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

			$BannerPath = resource_path('/assets/uploads/post/banner/' . $BannerImg); // upload path thumbnailex

			Image::make($Banner->getRealPath())->resize(890, 500)->brightness(1)->save($BannerPath);
		}







		if (!empty($map_package)) {

			$sep = "";

			foreach ($map_package as $map_pack) {

				$pack .= $sep . $map_pack;

				$sep = "|";
			}
		}

		if ($type == 1) {

			/*--------------------------upload image-----------------------------------*/

			$brochureimg = $request->file('brochure');

			if ($brochureimg == "") {

				$brochure = $old_image;
			} else {

				if (!empty($old_image)) {

					if (file_exists(resource_path('/assets/uploads/post/' . $old_image))) {

						unlink(resource_path('/assets/uploads/post/' . $old_image));
					}

					if (file_exists(resource_path('/assets/uploads/post/original/' . $old_image))) {

						unlink(resource_path('/assets/uploads/post/original/' . $old_image));
					}

					if (file_exists(resource_path('/assets/uploads/post/thumb/' . $old_image))) {

						unlink(resource_path('/assets/uploads/post/thumb/' . $old_image));
					}
				}



				$destinationPath = resource_path('/assets/uploads/post/original/'); // upload path

				$extension = $brochureimg->getClientOriginalExtension(); // getting image extension

				$brochure = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

				$thumbnail = resource_path('/assets/uploads/post/thumb/' . $brochure); // upload path thumbnailex

				Image::make($brochureimg->getRealPath())->resize(500, 250)->brightness(1)->save($thumbnail);

				$brochureimg->move($destinationPath, $brochure); // uploading file to given path

			}
		}

		if ($type == 2) {

			$brochure = $video;
		}





		/*--------------------------upload image end-----------------------------------*/



		/*----------------------Slug Start-------------------------------*/





		$table = 'blog_post';      /*------------Write table name---------------*/

		$field = 'post_alias';          /*------------Write field name---------------*/

		$slug = $alias;  /*------------Write title for slug-----------*/

		$slug = Str::slug($slug, "-");

		$key = NULL;

		$value = NULL;



		$i = 0;

		$params = array();

		$params[$field] = $slug;



		if ($key) $params["$key !="] = $value;

		if ($alias != $old_alias) {

			while (DB::table($table)->where($params)->get()->count()) {

				if (!preg_match('/-{1}[0-9]+$/', $slug))

					$slug .= '-' . ++$i;

				else

					$slug = preg_replace('/[0-9]+$/', ++$i, $slug);

				$params[$field] = $slug;
			}



			$alias2 = $slug;
		} else {

			$alias2 = $alias;
		}



		/*----------------------Slug End-------------------------------*/



		$GetCateType = DB::table('blog_category')->where('cate_id', $map_id)->first();



		$CateType = '';







		$Qry =  DB::table('blog_post')

			->where('post_id', $id)

			->update(['post_name' => $name, 'post_alias' => $alias2, 'post_desc' => $description, 'post_short_desc' => $short_description, 'post_image' => $brochure,  'post_mapped_id' => $map_id, 'cate_type' => $CateType, 'meta_title' => $meta_title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'post_image_alt' => $img_alt, 'type' => $type, 'tags' => $tags, 'map_package' => $pack, 'banner_image' => $BannerImg, 'post_date' => date("Y-m-d", strtotime($post_date)), 'post_month' => date("F-Y", strtotime($post_date))]);





		if ($Qry) {



			return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
		} else {

			return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
		}
	}



	public function post_delete($id, $image = NULL)
	{

		if (!empty($image)) {

			if (file_exists(resource_path('/assets/uploads/post/' . $image))) {

				unlink(resource_path('/assets/uploads/post/' . $image));
			}

			if (file_exists(resource_path('/assets/uploads/post/original/' . $image))) {

				unlink(resource_path('/assets/uploads/post/original/' . $image));
			}

			if (file_exists(resource_path('/assets/uploads/post/thumb/' . $image))) {

				unlink(resource_path('/assets/uploads/post/thumb/' . $image));
			}
		}

		$post = DB::table('blog_post')->where('post_id', $id)->delete();

		return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
	}



	public function slider_post_delete($id, $image = NULL)
	{

		if (!empty($image)) {

			if (file_exists(resource_path('/assets/uploads/blog-banner/' . $image))) {

				unlink(resource_path('/assets/uploads/blog-banner/' . $image));
			}

			if (file_exists(resource_path('/assets/uploads/post/blog-banner/' . $image))) {

				unlink(resource_path('/assets/uploads/post/blog-banner/' . $image));
			}

			if (file_exists(resource_path('/assets/uploads/post/blog-banner/' . $image))) {

				unlink(resource_path('/assets/uploads/post/blog-banner/' . $image));
			}
		}

		$post = DB::table('blog_image')->where('image_id', $id)->delete();

		return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
	}



	public function blog_meta()
	{

		$data = DB::table('cms_pages')->where('id', 15)->first();

		return view('control-panel.blog.blog-meta-management')->with(array('data' => $data));
	}



	public function blog_meta_update(Request $request)
	{

		$meta_title = $request->input('meta_title');

		$meta_description = $request->input('meta_description');

		$meta_keywords = $request->input('meta_keywords');

		DB::table('cms_pages')

			->where('id', 15)

			->update([
				'meta_title' => $meta_title,

				'meta_description' => $meta_description,

				'meta_keywords' => $meta_keywords
			]);



		return redirect(url('/control-panel/blog-management'))->with(array('success_msg' => Helper::updateMSG()));
	}



	public function change_post_status_trend($id, $status){
		DB::table('blog_post')
			->where('post_id', $id)
			->update(['post_trending' => $status]);
		return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
	}
	public function blog_comment_list(Request $request){
		$comment = BlogComment::with('blog')->orderBy('blog_comment_id','DESC')->get();
		
		return view('control-panel.comments.list', compact('comment'));
	}
	public function blog_comment_EditForm($Id){
	    $comment = BlogComment::where('blog_comment_id',$Id)->first();
	    $Html='';
	    $Html .='<div class="row"><input type="hidden" name="preId" value="'.$comment->blog_comment_id.'">
	                <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required text-danger">*</span> </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="name" id="name" value="'.$comment->name.'" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>';
        $Html .='<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="email" id="email" value="'.$comment->email.'" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>';
        $Html .='<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Message <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea class="form-control col-md-7 col-xs-12" name="comment">'.$comment->comment.'</textarea>
                    </div>
                  </div></div>';
	    echo $Html;
	}
    public function Edit_Comment(Request $r){
        $data = BlogComment::find($r->preId);
        $data->name = $r->name;
        $data->email = $r->email;
        $data->comment = $r->comment;
        $data->save();
        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }
	public function comment_status(Request $request)
	{
		$comment = BlogComment::where('blog_comment_id', $request->id)->first();
		$status = $comment->status;
		if ($status == 0) {
			BlogComment::where('blog_comment_id', $request->id)
				->update([
					'status' => 1
				]);
		} else {
			BlogComment::where('blog_comment_id', $request->id)
				->update([
					'status' => 0
				]);
		}
		return redirect('/control-panel/blog-comment-list')->with('success_msg', 'Status Change');
	}

	public function comment_delete(Request $request)
	{
		BlogComment::where('blog_comment_id', $request->id)->delete();
		return redirect('/control-panel/blog-comment-list')->with('success_msg', 'Comment Deleted Successfully');
	}
}
