<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceChecksController extends Controller
{
    public function index()
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('login');
        }
        else{
            $user = session('user');
            $price_checks = $this->getPriceChecks($user);
            $price_checks_grouped = $this->groupArray($price_checks);

            $data = array(
                'page' => 'PriceChecks',
                'price_checks' => $price_checks,
                'price_checks_grouped' => $price_checks_grouped
            );
            return view('admin.pricechecks',compact('user','data'));
        }
    }

    public function getPriceChecks($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "pricechecks";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=unlimited";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->pricechecks)
            {
                return $response_json->pricechecks;
            }
            else{
                // No PriceChecks.
                return null;
            }
        }
        catch (ClientErrorResponseException $e) {
            \Log::info("Client error :" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (ServerErrorResponseException $e) {
            \Log::info("Server error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (BadResponseException $e) {
            \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (\Exception $e) {
            \Log::info("Err" . $e->getMessage());
            return null;
        }
    }

    public function groupArray($array){
        $categories = array();

        if($array){
            foreach($array as $arr)
            { 
                $categories[$arr->drug_id][] = $arr;
            }

            $categories = array_values($categories);
        }

        return $categories;
    }
}
