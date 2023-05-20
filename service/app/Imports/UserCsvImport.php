<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Helper;
use DB;
use Auth;
use Illuminate\Support\Str;

class UserCsvImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $headerRow = $collection->first()->toArray();

        if(   $headerRow[0]!='description' OR
              $headerRow[1]!='model' OR
              $headerRow[2]!='price' OR
              $headerRow[3]!='condition' OR
              $headerRow[4]!='brand_name' OR
              $headerRow[5]!='category_name'
            )
            {
              return false
            }
            else
            {


    /*-----------------CSV Data insert start-----------------*/
    $product ='0';

    foreach ($collection as $key => $value)
          {

            if($key > 0)
            {
               /*----------------------Slug Start-------------------------------*/

                                   $table='product';      /*------------Write table name---------------*/
                                   $field='alias';          /*------------Write field name---------------*/
                                   $slug = $value[1];  /*------------Write title for slug-----------*/
                                   $slug = Str::slug($value[1], "-");
                                   $key2=NULL;
                                   $value3=NULL;

                                   $i = 0;
                                   $params = array ();
                                   $params[$field] = $slug;

                                   if($key2)$params["$key2 !="] = $value2;

                                   while (DB::table($table)->where($params)->get()->count())
                                   {
                                       if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                                           $slug .= '-' . ++$i;
                                       else
                                           $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
                                           $params [$field] = $slug;
                                   }


                                   $alias=$slug;
                  $Brandid ='0';

                  if(!empty($value[4]))
                  {
                      $check = DB::table('brand')->where('name',ucwords($value[4]))->first();

                      if(!empty($check))
                      {
                          $Brandid = $check->id;
                      }
                      else {

                          $Brandid = DB::table('brand')->insertGetId(['name'=>$value[4]]);
                      }

                  }


                  if(!empty($value[5]))
                  {
                    $check = DB::table('categories')->where('category_name',ucwords($value[5]))->first();

                    if(!empty($check))
                    {
                        $Categoryid = $check->category_id;
                    }
                    else {
                          $Alias = Helper::NewAlias('categories','category_name',$value[5]);
                        $Categoryid = DB::table('categories')->insertGetId(['category_name'=>$value[5],'category_alias'=>$Alias,'parent'=>0,'level'=>1]);
                    }
                  }


    /*----------------------Slug End-------------------------------*/


                    $tbdata = array(
                               'company_id' => Auth::user()->company_id,
                               'user_id' => Auth::user()->id,
                               'title' => $value[1],
                               'alias' => $alias,
                               'description' => $value[0],
                               'modal' => $value[1],
                               'price' => $value[2],
                               'condition' => $value[3],
                               'meta_title' => $value[1],
                               'meta_description' => $value[1],
                               'meta_keywords' => $value[1],
                               'brand'=>$Brandid,
                               'category'=>$Categoryid,

                       );

                    $product =	DB::table('product')->insertGetId($tbdata);

              }

            }

            return true


          }

    /*-----------------CSV Data insert start-----------------*/

    exit;

    }
}
