<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoosterviewsController extends Controller
{
    /** API URL */
    public $api_url = 'https://boosterviews.com/api/v2';

    /** Your API key */
    public $api_key = '';

    public function __construct()
    {
        $this->api_key = env('BOOSTER_VIEWS_API_KEY');
    }

    /** Add order */
    public function order($data)
    {
        $post = array_merge(['key' => $this->api_key, 'action' => 'add'], $data);
        return json_decode($this->connect($post), true);
    }

    /** Get order status  */
    public function status($order_id)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'status',
                'order' => $order_id
            ]),
            true
        );
    }

    /** Get orders status */
    public function multiStatus($order_ids)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'status',
                'orders' => $order_ids
            ]),
            true
        );
    }

    /** Get services */
    public function services()
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'services',
            ]),
            true
        );
    }

    /** Refill order */
    public function refill(int $orderId)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'refill',
                'order' => $orderId,
            ]),
            true
        );
    }

    /** Refill orders */
    public function multiRefill(array $orderIds)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'refill',
                'orders' => implode(',', $orderIds),
            ]),
            true,
        );
    }

    /** Get refill status */
    public function refillStatus(int $refillId)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'refill_status',
                'refill' => $refillId,
            ]),
            true
        );
    }

    /** Get refill statuses */
    public function multiRefillStatus(array $refillIds)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'refill_status',
                'refills' => implode(',', $refillIds),
            ]),
            true,
        );
    }

    /** Cancel orders */
    public function cancel(array $orderIds)
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'cancel',
                'orders' => implode(',', $orderIds),
            ]),
            true,
        );
    }

    /** Get balance */
    public function balance()
    {
        return json_decode(
            $this->connect([
                'key' => $this->api_key,
                'action' => 'balance',
            ]),
            true
        );
    }

    private function connect($post)
    {
        $_post = [];
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (is_array($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result = false;
        }
        curl_close($ch);
        return $result;
    }
}

// Examples

// $api = new Api();

// $services = $api->services(); # Return all services

// $balance = $api->balance(); # Return user balance

// // Add order

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'runs' => 2, 'interval' => 5]); # Default

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'keywords' => "test, testing"]); # SEO

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'comments' => "good pic\ngreat photo\n:)\n;)"]); # Custom Comments

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'usernames' => "test\nexample\nfb"]); # Mentions Custom List

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 1000, 'username' => "test"]); # Mentions User Followers

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test']); # Package

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'runs' => 10, 'interval' => 60]); # Drip-feed

// // Old posts only
// $order = $api->order(['service' => 1, 'username' => 'username', 'min' => 100, 'max' => 110, 'posts' => 0, 'delay' => 30, 'expiry' => '11/11/2022']); # Subscriptions

// // Unlimited new posts and 5 old posts
// $order = $api->order(['service' => 1, 'username' => 'username', 'min' => 100, 'max' => 110, 'old_posts' => 5, 'delay' => 30, 'expiry' => '11/11/2022']); # Subscriptions

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'username' => "test"]); # Comment Likes

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'answer_number' => '7']); # Poll

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'username' => 'username', 'comments' => "good pic\ngreat photo\n:)\n;)"]); # Comment Replies

// $order = $api->order(['service' => 1, 'link' => 'http://example.com/test', 'quantity' => 100, 'groups' => "group1\ngroup2"]); # Invites from Groups


// $status = $api->status($order->order); # Return status, charge, remains, start count, currency

// $statuses = $api->multiStatus([1, 2, 3]); # Return orders status, charge, remains, start count, currency
// $refill = (array) $api->multiRefill([1, 2]);
// $refillIds = array_column($refill, 'refill');
// if ($refillIds) {
//     $refillStatuses = $api->multiRefillStatus($refillIds);
// }
