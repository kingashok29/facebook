<?php

Route::get('/', [
  // here @ represent the name of method used inside the HomeController.
  // here / represent the home page. Show in below we are calling home controllers index function as method.
  'uses' => '\Facebook\Http\Controllers\HomeController@index',
  'as' => 'home',
]);

Route::get('/alert', function() {
  return redirect()->route('home')->with('info', 'You have signed up successfully!');
});

/* Contact page */
Route::get('/support/contact-us', ['uses' => '\Facebook\Http\Controllers\SupportController@getSupport', 'as' => 'support.contact-us',  ]);
Route::post('/support/contact-us', ['uses' => '\Facebook\Http\Controllers\SupportController@postSupport',  ]);


/*
 Here are Routes for Signup Page.
*/

Route::get('/signup', [
  'uses' => '\Facebook\Http\Controllers\AuthController@getSignup',
  'as' => 'auth.signup',
  'middleware' => ['guest'],
]);

Route::post('/signup', [
  'uses' => '\Facebook\Http\Controllers\AuthController@postSignup',
  'middleware' => ['guest'],
]);

Route::post('/signup/verify/{verificationCode}', [
  'uses' => '\Facebook\Http\Controllers\AuthController@confirm',
  'middleware' => ['guest'],
]);

/*
 Routes for Login page.
*/

Route::get('/signin', [
  'uses' => '\Facebook\Http\Controllers\AuthController@getSignin',
  'as' => 'auth.signin',
  'middleware' => ['guest'],
]);

Route::post('/signin', [
  'uses' => '\Facebook\Http\Controllers\AuthController@postSignin',
  'middleware' => ['guest'],
]);

/* Routes for signout page */

Route::get('/signout', [
  'uses' => '\Facebook\Http\Controllers\AuthController@getSignOut',
  'as' => 'auth.signout',
]);

/*
Routes for reseting password_hash
*/

Route::get('/password/forgot-password', [
  'uses' => '\Facebook\Http\Controllers\ForgotPasswordController@showLinkRequestForm',
  'as' => 'password.forgot-password',
  'middleware' => ['guest'],
]);

Route::post('/password/forgot-password/', [
  'uses' => '\Facebook\Http\Controllers\ForgotPasswordController@sendResetLinkEmail',
  'middleware' => ['guest'],
]);

Route::get('/password/reset-password/', [
  'uses' => '\Facebook\Http\Controllers\ResetPasswordController@showResetForm',
  'as' => 'password.reset-password',
  'middleware' => ['guest'],
]);

Route::post('/password/reset-password/{token}', [
  'uses' => '\Facebook\Http\Controllers\ResetPasswordController@reset',
  'middleware' => ['guest'],
]);


/* This route is for Search and redirecting user to search results */

Route::get('/search', [
  'uses' => '\Facebook\Http\Controllers\SearchController@getResults',
  'as' => 'search.results',
]);

/*
 Routes for Showing user profile, editing user profile.
 We also used middleware with Auth so other users who are not logged in can not access these pages.
*/

Route::get('/user/{username}', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@getProfile',
  'as' => 'profile.index',
]);

Route::get('/profile/edit/basic', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@getEditBasic',
  'as' => 'edit.basic',
  'middleware' => ['auth'],
]);

Route::get('/profile/edit/email-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@getEditEmail',
  'as' => 'edit.email-info',
  'middleware' => ['auth'],
]);

Route::get('/profile/edit/payment-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@getEditPayment',
  'as' => 'edit.payment-info',
  'middleware' => ['auth'],
]);

Route::get('/profile/edit/profile-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@getEditProfile',
  'as' => 'edit.profile-info',
  'middleware' => ['auth'],
]);



Route::post('/profile/edit/basic', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@postEditBasic',
  'middleware' => ['auth'],
]);


Route::post('/profile/edit/email-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@postEditEmail',
  'middleware' => ['auth'],
]);

Route::post('/profile/edit/payment-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@postEditPayment',
  'middleware' => ['auth'],
]);

Route::post('/profile/edit/profile-info', [
  'uses' => '\Facebook\Http\Controllers\ProfileController@postEditProfile',
  'middleware' => ['auth'],
]);

/*
 Routes for Friends page.
*/

Route::get('/friends', [
  'uses' => '\Facebook\Http\Controllers\FriendController@getIndex',
  'middleware' => ['auth'],
  'as' => 'friends.index',
]);


/*
Sending friend request
*/

Route::get('/friend/add/{username}', [
  'uses' => '\Facebook\Http\Controllers\FriendController@getAdd',
  'as' => 'friend.add',
  'middleware' => ['auth'],
]);

/*
Accepting friend requests
*/

Route::get('/friend/accept/{username}', [
  'uses' => '\Facebook\Http\Controllers\FriendController@getAccept',
  'as' => 'friend.accept',
  'middleware' => ['auth'],
]);

/*
Delete friend or unfriend
*/

Route::post('/friend/delete/{username}', [
  'uses' => '\Facebook\Http\Controllers\FriendController@postDelete',
  'as' => 'friend.delete',
  'middleware' => ['auth'],
]);


/*
Status Routes
*/

Route::post('/status', [
  'uses' => '\Facebook\Http\Controllers\StatusController@postStatus',
  'as' => 'status.post',
  'middleware' => ['auth'],
]);


/*
Status reply Routes
*/

Route::post('/status/{statusId}/reply', [
  'uses' => '\Facebook\Http\Controllers\StatusController@postReply',
  'as' => 'status.reply',
  'middleware' => ['auth'],
]);

/*
Bank Routes
*/

Route::get('user/{username}/bank', [
  'uses' => '\Facebook\Http\Controllers\BankController@showBank',
  'as' => 'bank.index',
  'middleware' => ['auth'],
]);

/*
New article route
*/

Route::get('/post/new-article', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@getArticlePage',
  'as' => 'post.new-article',
  'middleware' => ['auth'],
]);

Route::post('/post/new-article', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@postNewArticle',
  'middleware' => ['auth'],
]);

/*
Post Reply routes
*/

Route::post('post/{postId}/comment', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@postArticleReply',
  'as' => 'article.comment',
  'middleware' => ['auth'],
]);

/*
Showing user's posts.
*/

Route::get('/posts/my-posts', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@userPosts',
  'middleware' => ['auth'],
  'as' => 'posts.index',
]);

/*
Showing all posts
*/

Route::get('/posts/all-posts', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@allPosts',
  'as' => 'posts.all-posts',
]);

/* Showing drafts */

Route::get('/posts/all-drafts', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@viewDrafts',
  'middleware' => ['auth'],
  'as' => 'posts.all-drafts',
]);

/* Showing pending posts */

Route::get('/posts/pending-posts', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@showPendingPosts',
  'middleware' => ['auth'],
  'as' => 'posts.pending-posts',
]);


/*
Showing single post
*/

Route::get('/post/{slug}', [
  'uses' => '\Facebook\Http\Controllers\ArticleController@showPost',
  'as' => 'post.single-post',
]);

/*
Category Routes
*/

Route::get('/categories', [
  'uses' => '\Facebook\Http\Controllers\CategoryController@index',
  'as' => 'categories.index',
]);

Route::get('/categories/add-new', [
  'uses' => '\Facebook\Http\Controllers\CategoryController@getAddNew',
  'as' => 'categories.add-new',
]);

Route::post('/categories/add-new', [
  'uses' => '\Facebook\Http\Controllers\CategoryController@addNew',
  'as' => 'categories.add-new',
  'middleware' => ['auth'],
]);

/*
Likes Routes
*/

Route::get('/status/{statusId}/like', [
  'uses' => '\Facebook\Http\Controllers\StatusController@getLike',
  'as' => 'status.like',
  'middleware' => ['auth'],
]);
