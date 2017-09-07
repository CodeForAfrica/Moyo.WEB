<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WrongChecksController extends Controller
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
            $wrong_checks = $this->getWrongChecks($user);
            $data = array(
                'page' => 'WrongChecks',
                'wrong_checks' => $wrong_checks
            );
            return view('admin.wrongchecks.main',compact('user','data'));
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
            $url .= "wrongchecks";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->wrongcheck)
                {
                    $data = array(
                        'page' => 'WrongChecks',
                        'wrong_check' => $response_json->wrongcheck
                    );
                    return view('admin.wrongchecks.wrongcheck_view',compact('user','data'));
                }
                else{
                    // No Wrong Check.
                    return redirect('wrongchecks');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('wrongchecks');
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
            $url .= "wrongchecks";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Wrong Check removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('wrongchecks');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('wrongchecks');
            }
        }
    }

    public function getWrongChecks($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "wrongchecks";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=unlimited";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->wrongchecks)
            {
                return $response_json->wrongchecks;
            }
            else{
                // No WrongChecks.
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
}