<?php

class SubscribeController extends BaseController {

	public function subscribe()
	{
		if(Request::ajax()){
			$email = Input::get('email');
			//check if valid email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				//invalid email
				$response = array(
		            'status' => 'failure',
		            'msg' => 'Not a valid email address.',
		            'selector' => 'errormsg',
		        );
		 
		        return Response::json( $response );
			}

			//does email already exist?
			$subscriber = Subscriber::where('email', 'LIKE', $email)->first();
			if ($subscriber){
				$subscriber->subscribed = '1';
				$subscriber->save();
			}
			else { // new email address
				$subscriber = new Subscriber;
				$subscriber->email = $email;
				$subscriber->subscribed = '1';
				$subscriber->save();
			}

			$response = array(
	            'status' => 'success',
	            'msg' => 'Thank you. You will now receive Server Config email updates.',
	            'selector' => 'emailsubscribe',
	        );
	 
	        return Response::json( $response );
		}
	}

}