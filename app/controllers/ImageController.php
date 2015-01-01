<?php
   class ImageController extends BaseController {

    public function getIndex()
    {
	    //Loading the form view
	    return View::make('tpl.index');

    }

    public function postIndex()
    {
	    //Let's validate the form first with the rules which are set at the model
	    $validation = Validator::make(Input::all(), Photo::$upload_rules);
	    //If the validation fails, we redirect the user to the index page, with the error messages
	    if($validation->fails()) {
	    	return Redirect::to('/')
	    	->withInput()
	        ->withErrors($validation);
	    }
		else {
		    //If the validation passes, we upload the image to the database and process it
		    $image = Input::file('image');
		    //This is the original uploaded client name of the image
		    $filename = $image->getClientOriginalName();
		    //Because Symfony API does not provide filename without extension, we will be using raw PHP here
		    $filename = pathinfo($filename, PATHINFO_FILENAME);
		    //We should salt and make an url-friendly version of the filename
		    //(In ideal application, you should check the filename to be unique)
		    $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();
		    //We upload the image first to the upload folder, then get make a thumbnail from the uploaded image
		    $upload = $image->move(Config::get( 'image.upload_folder'), $fullname);
		    //Our model that we've created is named Photo, this library has an alias named Image, don't mix them two!
		    //These parameters are related to the image processing class that we've included, not really related to Laravel
		    Image::make(Config::get( 'image.upload_folder').'/'.$fullname)
		    	->resize(Config::get( 'image.thumb_width'), null, true)
		        ->save(Config::get('image.thumb_folder').'/'.$fullname);
		    //If the file is not uploaded, we show an error message to the user, else we add a new column to the database and show the success message
		    if($upload) {
		    	//image is now uploaded, we first need to add column to the database
		    	$insert_id = DB::table('photos')->insertGetId( array(
		    		'title' => Input::get('title'),
		            'image' => $fullname
		            )
		    	);
		    	//Now we redirect to the image's permalink
		    	return Redirect::to(URL::to('snatch/'.$insert_id))
		        	->with('success','Your image is uploaded successfully!');
			} else {
			    //image cannot be uploaded
			    return Redirect::to('/')->withInput()
			    	->with('error','Sorry, the image could not be uploaded, please try again later');
			}
		}
	}
}