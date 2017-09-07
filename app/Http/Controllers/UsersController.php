<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
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
            $users = $this->getUsers($user);

            $data = array(
                'page' => 'Users',
                'users' => $users
            );
            return view('admin.users.main',compact('user','data'));
        }
    }

    public function view($id)
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
            $url .= "users";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->user)
                {
                    $data = array(
                        'page' => 'Users',
                        'user' => $response_json->user
                    );
                    return view('admin.users.user_view',compact('user','data'));
                }
                else{
                    // No user.
                    return redirect('users');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('users');
            }
        }
    }

    public function update(Request $request)
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
            $url .= "users";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'name' => $request->name,
                'email' => $request->email,
                'api_token' => $request->api_token
            );
            
            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->user)
                {
                    return redirect()->back()->with(['message' => 'User details are updated.','class' => 'success']);
                }
                else{
                    // No User.
                    return redirect('users');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('users');
            }
        }
    }

    public function edit($id)
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
            $url .= "users";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->user)
                {
                    $data = array(
                        'page' => 'Users',
                        'user' => $response_json->user
                    );
                    return view('admin.users.user_edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('users');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('users');
            }
        }
    }

    public function create(Request $request)
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
            $url .= "users";
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'api_token' => str_random(60)
            );
            
            try{
                $response = $client->request('POST', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->user)
                {
                    return redirect()->back()->with(['message' => 'User added.','class' => 'success']);
                }
                else{
                    // No User.
                    return redirect('admin/users');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('users');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('users');
            }
        }
    }

    public function delete($id)
    {
       // To Do : Deleting users.
       return redirect('admin/users');
    }

    public function getUsers($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "users";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=unlimited";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->users)
            {
                return $response_json->users;
            }
            else{
                // No Users.
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