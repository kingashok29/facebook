<?php

namespace Facebook\Http\Controllers;

use Illuminate\Http\Request;

use Facebook\Models\Category;
use Facebook\Models\Article;
use Facebook\Models\Comment;
use Facebook\Models\User;
use Image;
use Auth;

class ArticleController extends Controller
{
    // Accessing Add new article page.
    public function getArticlePage() {
      $categories = Category::where('status','1')->get();
      return view('post.new-article')->with('categories', $categories);
    }


      // Showing posts of user
    public function userPosts() {
      $posts = Article::where('status', '1')->where('draft','0')->Where('posted_by', Auth::user()->id)->get();
      $count = $posts->count();
      return view('posts.index')->with('posts', $posts)->with('count', $count);
    }

    // Showing all posts available on site
    public function allPosts() {
      $posts = Article::where('status','1')->where('draft','0')->get();
      $count = $posts->count();
      return view('posts.all-posts')
              ->with('posts', $posts)
              ->with('count', $count);
    }

    // SHowing drafts to user's profile.
    public function viewDrafts() {
      $drafts = Article::where('posted_by', Auth::user()->id)->where('draft','1')->get();
      $count = $drafts->count();
      return view('posts.all-drafts', compact('drafts','count'));
    }

    // Showing pending posts
    public function showPendingPosts() {
      $pending_posts = Article::where('posted_by', Auth::user()->id)
                              ->where('status','0') // If status is 1 means already published.
                              ->where('draft','0') // If draft is 1 then show in drafts not here.
                              ->get();
      $count = $pending_posts->count();
      return view('posts.pending-posts', compact('pending_posts','count'));
    }

     // Showing single post
     public function showPost($slug) {
         $post = Article::where('slug', $slug)->first();

         if(!$post) {
           abort('404');
         }

         if($post->draft === 1) {
           return redirect()->route('posts.all-posts')->with('danger','You can not view the post which is currently in draft.');
         }

         if($post->status === 0) {
           return redirect()->route('posts.all-posts')->with('danger','You can not view the post which is pending for approval.');
         }

         $username = User::where('id', $post->posted_by)->first();
         $category = Category::where('category_id', $post->category_id)->first();

         return view('post.single-post', compact('post','username','category'));
     }

      // Posting new article to database.
    public function postNewArticle(Request $request) {
      $this->validate($request, [
        'title' => 'required|min:10|unique:posts|max:255',
        'summery' => 'required|min:20|max:255',
        'body' => 'required|min:10',
        'image' => 'required|file|image',
        'category' => 'required|not_in:0',
        'image_credit' => 'required|min:10|max:255',
      ]);

      $slug_data = $request->title;
      $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_data));

      if($request->hasFile('image')) {
        $post_image = $request->file('image');
        $filename = time(). '.' . $post_image->getClientOriginalExtension();
        Image::make($post_image)->resize(600, 100)->save( public_path('images/post-images/'.$filename ));
      } else {
        $filaname = 'default-post.png';
      }

      Article::create([
        'status' => '0',
        'title' => $request->title,
        'slug' => $slug,
        'summery' => $request->summery,
        'body' => $request->body,
        'image' => $filename,
        'category_id' => $request->category,
        'image_credit' => $request->image_credit,
        'posted_by' => Auth::user()->id,
        'status_reason' => 'No action has benn taken yet, check back soon.',
      ]);

      return redirect()->route('home')
            ->with('info','Your article submitted for review and after approvel it will appear on website, thanks :)');
    }

    public function postArticleReply(Request $request, $postId, Article $article) {
        $this->validate($request, [
          "article-comment" => 'required|min:50|max:1000',
        ], [
          "required" => "Comment body is required to submit comment",
          "min" => "Comment must be at least 50 characters long",
          "max" => "Comment should not exceed 1000 characters long",
        ]);

        $post = Article::where('id', $postId)->first();

        if(!$post) {
          return redirect()->back()->with('error', 'Sorry but you can not reply this post as this article does not exists in database');
        }

        dd($request->get('article-comment'));

    }

}
