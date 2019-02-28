<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DrugTransformer;
class DrugsController extends Controller
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
            $drugs = $this->getDrugs();
            $tablet_drugs = $this->search($drugs,"form","Tablet");
            $liquid_drugs = $this->search($drugs,"form","Liquid");
            $capsule_drugs = $this->search($drugs,"form","Capsule");
            $cream_drugs = $this->search($drugs,"form","Cream");
            $gel_drugs = $this->search($drugs,"form","Gel");
            $granules_drugs = $this->search($drugs,"form","Granules");
            $inhalation_drugs = $this->search($drugs,"form","Inhalation");
            $injection_drugs = $this->search($drugs,"form","Injection");
            $ointment_drugs = $this->search($drugs,"form","Ointment");
            $pessary_drugs = $this->search($drugs,"form","Pessary");
            $solution_drugs = $this->search($drugs,"form","Solution");
            $suppository_drugs = $this->search($drugs,"form","Suppository");
            $suspension_drugs = $this->search($drugs,"form","Suspension");
            $syrup_drugs = $this->search($drugs,"form","Syrup");

            $data = array(
                'page' => 'Drugs',
                'drugs' => $drugs,
                'tablet_drugs' => $tablet_drugs,
                'liquid_drugs' => $liquid_drugs,
                'capsule_drugs' => $capsule_drugs,
                'cream_drugs' => $cream_drugs,
                'gel_drugs' => $gel_drugs,
                'granules_drugs' => $granules_drugs,
                'inhalation_drugs' => $inhalation_drugs,
                'injection_drugs' => $injection_drugs,
                'ointment_drugs' => $ointment_drugs,
                'pessary_drugs' => $pessary_drugs,
                'solution_drugs' => $solution_drugs,
                'suppository_drugs' => $suppository_drugs,
                'suspension_drugs' => $suspension_drugs,
                'syrup_drugs' => $syrup_drugs,
            );
            return view('admin.drugs.main',compact('user','data'));
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
            $drugs = $this->getDrugs();

            $data = array(
                'page' => 'Drugs',
                'drugs' => $drugs
            );
            return view('admin.drugs.viewall',compact('user','data'));
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
            $url .= "drugs";
            $url .= "/";
            $url .= $id;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->drug)
                {
                    $data = array(
                        'page' => 'Drugs',
                        'drug' => $response_json->drug
                    );
                    return view('admin.drugs.drugview',compact('user','data'));
                }
                else{
                    // No Drug.
                    return redirect('drugs');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('drugs');
            }
        }
    }

    public function edit($id=0)
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
            $url .= "drugs";
            $url .= "/";
            $url .= $id;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->drug)
                {
                    $data = array(
                        'page' => 'Drugs',
                        'drug' => $response_json->drug
                    );
                    return view('admin.drugs.drug_edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('drugs');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('drugs');
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
            $url .= "drugs";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Drug removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('drugs');
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
            $url .= "drugs";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'name' => $request->name,
                'form' => $request->form,
                'strength' => $request->strength,
                'uom' => $request->uom,
                'price' => $request->price
            );

            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->drug)
                {
                    return redirect()->back()->with(['message' => 'Drug details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('drugs');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('drugs');
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
            $url .= "drugs";
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'name' => $request->name,
                'form' => $request->form,
                'strength' => $request->strength,
                'uom' => $request->uom,
                'price' => $request->price
            );

            try{
                $response = $client->request('POST', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->drug)
                {
                    return redirect()->back()->with(['message' => 'Drug added.','class' => 'success']);
                }
                else{
                    // No Drug.
                    return redirect('drugs');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('drugs');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('drugs');
            }
        }
    }

    public function getDrugs()
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "drugs?limit=unlimited";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->drugs)
            {
                return DrugTransformer::transform($response_json->drugs);
            }
            else{
                // No Drugs.
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

    public function search($array, $field, $value)
    {
        $res = array();
        if($array){
            foreach($array as $key => $arr)
            {
                if ($arr->$field === $value )
                    $res[] = $arr;
            }
        }

        return $res;
    }
}
