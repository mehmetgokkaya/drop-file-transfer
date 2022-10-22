<?php
function delFolder ($folder) {
  // (A1) GET ALL FILES + FOLDERS
  $all = glob("$folder*", GLOB_BRACE);

  if (count($all)>7) { foreach ($all as $a) {
    // (A2) FOLDER - RECURSIVE DELETE
    if (is_dir($a)) { delFolder("$a/");  }

    // (A3) DELETE FILES
    else {
      echo unlink($a)
          ? "$a deleted\r\n"
          : "Error deleting $a\r\n" ;
    }
  }}

  // (A4) DELETE CURRENT FOLDER ITSELF
  //echo rmdir($folder)
    //? "$folder deleted\r\n" 
    //: "Error deleting $folder\r\n" ;
}

{
    //mkdir("upload",0777);
}

// (B) GO!
delFolder("upload/*");
?>