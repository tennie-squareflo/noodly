<?php
//https://stripe.com/docs/api

class Stripe_Model {
    protected $app;
    protected $db;
    private $parent;
    private $publicKey;
    private $secretKey;
    private $clientId;
    private $tokenUrl = 'https://connect.stripe.com/oauth/token';
    private $connectUrl = 'https://connect.stripe.com/oauth/authorize?response_type=code&scope=read_write&stripe_landing=login&client_id=[CLIENT_ID]';
    private $redirectUrl = 'http://dev.noodly.com/yqrdaily/settings/stripe?action=stripe-connect-response';
    private $lastResponseSuccess = false;
    private $lastResponseMessage = '';

    function __construct() {
        $this->app = App::get_instance();
        $this->db = $this->app->db;
        $this->publicKey = STRIPE_PUBLIC_KEY;
        $this->secretKey = STRIPE_SECRET_KEY;
        $this->clientId = STRIPE_CLIENT_ID;
        $this->connectUrl = str_replace("[CLIENT_ID]",STRIPE_CLIENT_ID,$this->connectUrl);
    }

    public function getlastResponse(){
        return $this->lastResponseSuccess;
    }
    public function getlastResponseMessage(){
        return $this->lastResponseMessage;
    }

    public function includeLibrary(){
        require_once(CORE_PATH.'libraries/stripe-php-master/init.php');
    }

    public function setParentClass($parent){
        $this->parent = $parent;
    }

    public function forwardToConnectPage(){
        $s_connectUrl = $this->connectUrl;
        //$s_connectUrl = str_replace("[CLIENT_ID]",$config['stripe']['keys'][$_REQUEST['live'] == '1' ? 'live' : 'test']['client_id'],$s_connectUrl);
        header("Location: ".$s_connectUrl."&amp;redirect_uri=".urlencode($this->redirectUrl));
        exit;
    }
    public function getConnectAction(){
        return 'stripe-connect';
    }
    public function getDisconnectAction(){
        return 'stripe-disconnect';
    }

    public function connect($code){
        if($code == ''){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'There was no code found.';
            return false;
        }

        $fields = array(
            'client_secret' => urlencode($this->secretKey),
            'code' => urlencode($code),
            'grant_type' => 'authorization_code'
        );
        $fieldsString = '';
        foreach($fields as $key=>$value){
            $fieldsString .= $key.'='.$value.'&';
        }
        rtrim($fieldsString, '&');

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $this->tokenUrl);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $stripeResult = json_decode($result,true);

        if(count($stripeResult) > 0 && is_array($stripeResult) && isset($stripeResult['error']) && $stripeResult['error'] != ''){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Could not connect to Stripe. Error: '.$stripeResult['error_description'].' [e.sm.c.1]';
            return false;
        }

        if(
            count($stripeResult) == 0
            || !is_array($stripeResult)
            || !isset($stripeResult['access_token'])
            || (isset($stripeResult['access_token']) && $stripeResult['access_token'] == '')
        ){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Could not connect to Stripe. Please try again or contact us. [e.sm.c.2]';
            return false;
        }

        $dataToSave = array(
            'id'		        => $stripeResult['stripe_user_id'],
            'access_token'		=> $stripeResult['access_token'],
            'publishable_key'	=> $stripeResult['stripe_publishable_key'],
            'refresh_token'		=> $stripeResult['refresh_token'],
            'token_type'		=> $stripeResult['token_type'],
            'livemode'          => $stripeResult['livemode'],
            'scope'             => $stripeResult['scope'],
            'email'             => '',
            'display_name'      => ''
        );

        $this->includeLibrary();
        \Stripe\Stripe::setApiKey($dataToSave['access_token']);
        $stripeErrorResponse = null;
        try{
            $stripeAccount = \Stripe\Account::retrieve();
            $dataToSave['email'] = $stripeAccount->email;
            $dataToSave['display_name'] = $stripeAccount->display_name;
        } catch(Stripe_Error $e){
            $stripeErrorResponse = $e;
        }

        if($stripeErrorResponse != null){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Could not connect to Stripe. Please try again or contact us. [e.sm.c.3]';
            if(isset($stripeErrorResponse->json_body['error']['message'])){
                $this->lastResponseMessage .= '<br /><br />('.$stripeErrorResponse->json_body['error']['message'].')';
            }
            return false;
        }

        $this->lastResponseSuccess = true;

        return $dataToSave;
    }

    public function disconnect(){
        $publisherId = isset($this->parent->view_data['publisher']['pid']) ? $this->parent->view_data['publisher']['pid'] : 0;
        if($publisherId == 0){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Could not find the publisher account. [e.sm.d.1]';
            return false;
        }

        $stripeData = $this->getStripeSettingsFromPublisher();

        $this->includeLibrary();
        \Stripe\Stripe::setApiKey($this->secretKey);
        $stripeErrorResponse = null;
        $disconnectResponse = null;
        try {
            $disconnectResponse = \Stripe\OAuth::deauthorize([
                'client_id' => $this->clientId,
                'stripe_user_id' => $stripeData['id'],
            ]);
        } catch(Stripe_Error $e){
            $stripeErrorResponse = $e;
        } catch (Stripe_InvalidRequestError $e) {
            $stripeErrorResponse = $e;
        } catch (Stripe_ClientException $e) {
            $stripeErrorResponse = $e;
        } catch (Exception $e) {
            $stripeErrorResponse = $e;
        }

        $errorCode = '';
        if($stripeErrorResponse != null){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Could not disconnect your Stripe account. Please try again or contact us. [e.sm.d.2]';
            if(isset($stripeErrorResponse->json_body['error']['message'])){
                $this->lastResponseMessage .= '<br /><br />('.$stripeErrorResponse->json_body['error']['message'].')';
                return false;
            } else {
                $error = $stripeErrorResponse->getError();
                if($error->error == 'invalid_client'){
                    $errorCode = $error->error;
                } else {
                    $this->lastResponseMessage .= '<br /><br />('.$stripeErrorResponse->getMessage().')';
                    return false;
                }
            }
        }

        if(
            $errorCode != 'invalid_client'
            &&
            (
                !isset($disconnectResponse->stripe_user_id)
            )
        ){
            $this->lastResponseSuccess = false;
            $this->lastResponseMessage = 'Something went wrong, please try again or contact us [e.sm.d.3]';
            return false;
        }

        return true;
    }

    public function getStripeSettingsFromPublisher($publisherId=''){
        $stripeSettings = isset($this->parent->view_data['publisher']['stripe']) ? $this->parent->view_data['publisher']['stripe'] : '';

        if($publisherId != ''){
            $this->db->where(array(
                'pid' => $publisherId
            ));
            $publisher = $this->db->get('publishers','`stripe`');
            if(isset($publisher[0]['stripe'])){
                $stripeSettings = $publisher[0]['stripe'];
            }
        }

        if($stripeSettings != ''){
            $stripeSettings = unserialize($stripeSettings);
        }
        if(!is_array($stripeSettings)){
            $stripeSettings = array();
        }
        return $stripeSettings;
    }
    public function updatePublisherStripeData($dataToSave,$publisherId=''){
        if(!is_array($dataToSave)){
            $dataToSave = array();
        }
        if($publisherId == ''){
            $publisherId = isset($this->parent->view_data['publisher']['pid']) ? $this->parent->view_data['publisher']['pid'] : 0;
        }
        $this->db->where(array(
            'pid' => $publisherId
        ));
        return $this->db->update('publishers',array(
            'stripe' => serialize($dataToSave)
        ));
    }
    public function clearPublisherStripeData($publisherId=''){
        return $this->updatePublisherStripeData(array(),$publisherId);
    }

    public function getStripeSettingsFromUser($userId=''){
        if($userId == ''){
            $userId = $_SESSION['user']['uuid'];
        }

        $stripeSettings = '';

        if($userId != ''){
            $this->db->where(array(
                'uuid' => $userId
            ));
            $user = $this->db->get('users','`stripe`');
            if(isset($user[0]['stripe'])){
                $stripeSettings = $user[0]['stripe'];
            }
        }

        if($stripeSettings != ''){
            $stripeSettings = unserialize($stripeSettings);
        }
        if(!is_array($stripeSettings)){
            $stripeSettings = array();
        }
        return $stripeSettings;
    }
    public function updateUserStripeData($dataToSave,$userId=''){
        if($userId == ''){
            $userId = $_SESSION['user']['uuid'];
        }
        if(!is_array($dataToSave)){
            $dataToSave = array();
        }
        if($userId == ''){
            return false;
        }
        $this->db->where(array(
            'uuid' => $userId
        ));
        return $this->db->update('users',array(
            'stripe' => serialize($dataToSave)
        ));
    }
    public function clearUserStripeData($userId=''){
        return $this->updateUserStripeData(array(),$userId);
    }
}
