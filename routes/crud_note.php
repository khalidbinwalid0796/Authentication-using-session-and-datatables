<?php

use Illuminate\Support\Facades\Route;

//Rrsource Route
Route::resource('product', 'ProductController');

/****************
 * Data Inser
 ****************/
//(1) use new keyword for data insert
    $user = new User();
    $user->usertype = $request->usertype;
    $user->save();

//(2) create()->used for single data insert
Route::get('product', function(){
    $data=[
        'product_code'=>'1234',
        'product_name'=>'hp',
    ];
    return Product::create($data);
});

//(3)insert()->used for multiple data insert
Route::get('product', function(){
    $data=[
            ['product_code'=>1234,
            'product_name'=>'hp',],
            ['product_code'=>234,
            'product_name'=>'dell',],
        ];
    return Product::insert($data);
    //1 return kore
});

/****************
 * Data Fetch
 ****************/

 //fetch all data
$categories = Category::all();

//for edit, update, delete
$category = Category::find($id);
$category->cat_name //data access kora hoy aivabe
//find ar poriborte nicher query ta likhle hoy
$category = Category::where('id',1)->first();//1 ta data return kore mane limit 1
$category->cat_name //data access kora hoy aivabe

//(1) update
$category = new Category();
$category->name = $request->name;
$category->update();//update or save likhle hoy

//(2) update
$category = Category::find($id)->update([
    $category->name = $request->name;
]);

//delete findOrFail()-> id na thakle error generate kore na, 404 not found dekhai
$category = Category::findOrFail($id)->delete();

//but get() return an array ai jonn foreach loop use kora hoy
$category = Category::where('id',1)->get();

//max(), min(), count(), sum()
$category = Category::where('brand_id',1)->sum();

/* 
where, orWhere,whereDay, whereMonth, whereaYear, whereTime,whereNotIn, whereNotBetween,
whereIn('id',[1,5]), only 1 & 5 id jukto data return korbe
whereBetween('id',[1,5]),1 theke 5 moddhe j j id gulo ase tader nie asbe 
not sign-> '<>' or '!='
*/

/* 
orderBy, latest(), oldest(), inRandomOrder(), groupBy(), having(),
skip(10), 0-9 index porjonto skip kore 10 no index theke data dekhabe
offset(10), direct 10 no index theke data dekhabe
take(3) take & limit same
limit(3)
Category::limit(3) model ar poree use kora best
groupBy() korte hole must select kore nite hobe, same to having may be
*/