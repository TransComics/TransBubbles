<?php
namespace Transcomics\BingTranslation;

class BingTranslation extends \AbstractTranslator {

    private $clientID;

    private $clientSecret;

    private $_oAuth2Url = 'https://datamarket.accesscontrol.windows.net/v2/OAuth2-13';

    private $_languageUrl = 'http://api.microsofttranslator.com/V2/Http.svc/Translate';

    private $_scopeUrl = 'http://api.microsofttranslator.com';

    public function __construct($cid, $secret) {
        $this->clientID = $cid;
        $this->clientSecret = $secret;
    }

    private function get_access_token() {
        // if access token is not expired and is stored in COOKIE
        if (isset($_COOKIE['bing_access_token'])) {
            return $_COOKIE['bing_access_token'];
        }
        
        // Get a 10-minute access token for Microsoft Translator API.
        $url = $this->_oAuth2Url;
        $postParams = 'grant_type=client_credentials&client_id=' . urlencode($this->clientID) . '&client_secret=' . urlencode($this->clientSecret) . '&scope=' . $this->_scopeUrl;
        
        \Log::debug('get_access_token()  postParams :' . $postParams);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // Set HTTP POST Request.
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        
        // CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Execute the cURL session.
        $strResponse = curl_exec($ch);
        
        $encoding = mb_detect_encoding($strResponse);
        
        if ($encoding == 'UTF-8') {
            $result = preg_replace('/[^(\x20-\x7F)]*/', '', $strResponse);
        } else {
            $result = preg_replace('!,+!', ',', $strResponse);
        }
        
        // Get the Error Code returned by Curl.
        $curlErrno = curl_errno($ch);
        if ($curlErrno) {
            $curlError = curl_error($ch);
            throw new \Exception($curlError);
        }
        // Close the Curl Session.
        curl_close($ch);

        $result = str_replace('&quot;', '"', $result);
        $result = str_replace('\\', '', $result);
        
        // This will remove unwanted characters.
        // Check http://www.php.net/chr for details
        for ($i = 0; $i <= 31; ++ $i) {
            $result = str_replace(chr($i), "", $result);
        }
        $result = str_replace(chr(127), "", $result);
        
        // This is the most common part
        // Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
        // here we detect it and we remove it, basically it's the first 3 characters
        if (0 === strpos(bin2hex($result), 'efbbbf')) {
            $result = substr($result, 3);
        }
        // Decode the returned JSON string.
        
        $objResponse = json_decode($result);
        
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                \Log::debug(' - No errors');
                break;
            case JSON_ERROR_DEPTH:
                \Log::error(' - Maximum stack depth exceeded');
                break;
            case JSON_ERROR_STATE_MISMATCH:
                \Log::error(' - Underflow or the modes mismatch');
                break;
            case JSON_ERROR_CTRL_CHAR:
                \Log::error(' - Unexpected control character found');
                break;
            case JSON_ERROR_SYNTAX:
                \Log::error(' - Syntax error, malformed JSON');
                break;
            case JSON_ERROR_UTF8:
                \Log::error(' - Malformed UTF-8 characters, possibly incorrectly encoded');
                break;
            default:
                \Log::error(' - Unknown error');
                break;
        }
        
        if (isset($objResponse->error)) {
            throw new \Exception($objResponse->error_description);
        }
        $access_token = $objResponse->access_token;
        setcookie('bing_access_token', $access_token, $objResponse->expires_in);
        
        return $access_token;
    }

    public function translate($word, $from, $to) {
        try {
            $access_token = $this->get_access_token();
        } catch (\Exception $e) {
            return \Response::json(array(
                'errorReason' => $e->getMessage()
            ));
        }
        
        $url = $this->_languageUrl . '?text=' . urlencode($word) . '&from=' . $from . '&to=' . $to;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:bearer ' . $access_token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $rsp = curl_exec($ch);
        
        preg_match_all('/<string (.*?)>(.*?)<\/string>/s', $rsp, $matches);
        
        return \Response::json(array(
            'translation' => $matches[2][0]
        ));
    }
}

?>
