<?php

require_once 'search.php';

class Bentral_Search_Controller extends WP_REST_Controller
{
    public function register_routes()
    {
        register_rest_route('bentral', '/search/lang/(?P<lang>(.+))/persons/(?P<persons>(.+))/from/(?P<from>(.+))/to/(?P<to>(.+))/tags/(?P<tags>(.+))', [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'search'],
                'args'                => [],
                'permission_callback' => '__return_true'
            ]
        ]);

        register_rest_route('bentral', '/v2/search', [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'search'],
                'args'                => [],
                'permission_callback' => '__return_true'
            ]
        ]);
    }

    public function search(WP_REST_Request $request)
    {
        try {
            $bentral_search = new Bentral_Search();
            return new WP_REST_Response([
                'result' => $bentral_search->search(
                    $request->get_param('lang'),
                    $request->get_param('persons'),
                    $request->get_param('from'),
                    $request->get_param('to'),
                    $request->get_param('tags')
                ),
            ]);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
