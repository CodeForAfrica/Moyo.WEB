<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PriceChecksExport;
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
            return view('admin.pricechecks.main',compact('user','data'));
        }
    }

    public function viewall()
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('login');
        }
        else{
            $user = session('user');
            $price_checks = $this->getPriceChecks($user);

            $data = array(
                'page' => 'PriceChecks',
                'price_checks' => $price_checks
            );
            return view('admin.pricechecks.viewall',compact('user','data'));
        }
    }

    public function view($id=0)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "pricechecks";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->pricecheck)
                {
                    $data = array(
                        'page' => 'PriceChecks',
                        'price_check' => $response_json->pricecheck
                    );
                    return view('admin.pricechecks.pricecheck_view',compact('user','data'));
                }
                else{
                    // No Price Check.
                    return redirect('pricechecks');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                dd($e->getResponse()->getBody(true));
                //return redirect('pricechecks');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                dd($e->getResponse()->getBody(true));
                //return redirect('pricechecks');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                dd($e->getResponse()->getBody(true));
                //return redirect('pricechecks');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                dd($e->getMessage());
                //return redirect('pricechecks');
            }
        }
    }

    public function delete($id)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "pricechecks";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Price Check removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('pricechecks');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('pricechecks');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('pricechecks');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('pricechecks');
            }
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

    /**
     * Export to Xlsx
     */
    function export(){
        $user = session('user');

        $price_checks = $this->getPriceChecks($user);
        $formatted_price_checks = [];
        foreach($price_checks as $Item){
            $Drug = [
                'name' => $Item->drug->name,
                'price' => $Item->drug->price,
                'buying_price' => $Item->buying_price,
                'status' => ucfirst($Item->status),
                'extra_amount' => $Item->extra_amount,
                'phone_number' => $Item->checker_phone_number ,
                'date_checked' => date('M j Y g:i A', strtotime($Item->created_at)),
            ];
            
            array_push($formatted_price_checks,$Drug);
        }

        return new PriceChecksExport($formatted_price_checks);
    }
}
