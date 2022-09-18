<?php

namespace App\Http\Controllers;

class NewsletterController extends Controller
{
    /**
     * @see https://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#create-post_lists_list_id_members
     */
    public function subscribe()
    {
        $api_key = get_option('mailchimp_api_key');
        $list_id = get_option('mailchimp_list_id');

        if (!$api_key || !$list_id) {
            return __('Make sure to set the Mailchimp API key and list ID from the admin settings.');
        }

        $dc = explode("-", $api_key)[1];
        $url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$list_id}/members";

        $response = curlRequest($url, 'POST', json_encode([
            'email_address' => request()->post('email'),
            'status' => 'pending',
        ]), ['Content-Type: application/x-www-form-urlencoded'], [
            CURLOPT_USERPWD => "anystring" . ":" . $api_key,
        ]);


        if ($response->error) {
            return [
                'status' => 0,
                'message' => $response->error,
            ];
        }

        $response_body = json_decode($response->body, true);

        if (is_integer($response_body['status'])) {
            if (isset($response_body['errors'])) {
                $error = $response_body['errors'][0]['message'];
            } else {
                $error = $response_body['detail'];
            }

            return [
                'status' => 0,
                'message' => $error //$response_body['title']
            ];
        }

        return [
            'status' => 1,
            'message' => $response_body['status'],
        ];
    }
}
