<?php
use Illuminate\Support\Facades\Config;
use App\Models\Mojjam;
use App\Http\Requests\MojjamRequest;


  function uploadImage($folder, $image)
  {
      $image->store('/', $folder);
      $filename = $image->hashName();
      $path = 'images/' . $folder . '/' . $filename;
      return $path;
  }
/* check record exists in case of create */
  function getold($table,$col,$requestinput)
  {
    if($table::where($col, $requestinput )->exists()){
        return  true;
       }
  }

  /* check record exists in case of upate */
  function getresult($table,$col,$requestinput,$colid,$table_id)
  {
    if($table::where($col,'=' ,$requestinput)->where($colid,'!=' ,$table_id )->exists()){
        return true;
    }
  }

  /* check record by (word_id) and abyaat->id or  (word_id) and sentences->id exists in case of create */
  function getrow($table,$col,$requestinput,$colid,$table_id)
  {
    if($table::where($col, $requestinput )->
    where($colid,'=',$table_id )->exists()){
        return  true;
       }
  }
