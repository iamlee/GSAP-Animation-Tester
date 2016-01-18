<?php
// check if a form was submitted
if( !empty( $_POST ) ){

//echo $_POST

// convert form data to json format
//    $postArray = array(
//      "pausedTime" => $_POST['pausedTime'],
//      "note-info" => $_POST['note-info']
//    ); //you might need to process any other post fields you have..

//$json = json_encode( $postArray );
// make sure there were no problems
//if( json_last_error() != JSON_ERROR_NONE ){
    //exit;  // do your error handling here instead of exiting
// }
$file = 'comments.json';
// write to file
//   note: _server_ path, NOT "web address (url)"!
file_put_contents( $file, $_POST);
}
