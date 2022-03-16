<?php

if (!class_exists('Bentral_Request')) {

    class Bentral_Request
    {
        const BASE_URL = 'https://api.bentral.com';
        protected $responseCode;
        protected $data;


        public static function getUrl($apiPath)
        {
            return self::BASE_URL . $apiPath;
        }

        public function getResponseCode()
        {
            return $this->responseCode;
        }

        public function getData()
        {
            return $this->data;
        }

        protected function resetData()
        {
            $this->responseCode = null;
            $this->data         = null;
        }


        public function execute($apiPath, $apiKey = null)
        {
            $this->resetData();
            if (boolval(get_option('bentral_https_ssl_verify')) == false){
                add_filter('https_ssl_verify', '__return_false');
            }
            $http = new WP_Http();

            if (empty($apiKey)) {
                $apiKey = get_option('bentral_api_key');
            }

            try {
                $result = $http->request($this->getUrl($apiPath), [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-API-KEY'    => $apiKey
                    ],
                    'method'  => 'GET'
                ]);
                if (is_array($result)){
                    $this->responseCode = intval($result['response']['code']);
                    $this->data         = json_decode($result['body'], true);
                } else {
                    $this->responseCode = 495;
                    $this->data = $result;
                }
            } catch (Exception $e) {
                $this->data = $e->getMessage();
            }
            return $this;
        }
    }
}