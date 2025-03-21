<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\NotificationSetting;
use App\Models\RoleRestriction;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(){

        $shop = Auth::user();
        if(!$shop){
            return response()->json([
                "status"=>404,
                "message"=>"Store not found.",
            ]);
        }
        $shopName = Auth::user()->name;
        


        $general_settings = GeneralSetting::where('shopName', $shopName)->first();
        $role_restriction_settings = RoleRestriction::where('shopName', $shopName)->first();
        $notification_settings = NotificationSetting::where('shopName',$shopName)->first();
        


        $productGids = $role_restriction_settings->specific_products ?? [];
        $collectionGids = $role_restriction_settings->include_collections ?? [];


        $productNames = $this->fetchShopifyProductNames($shop, $productGids); 
        
        $collectionNames = $this->fetchShopifyCollectionNames($shop,$collectionGids );

        return view('welcome', compact('general_settings', 'role_restriction_settings','productNames','collectionNames','notification_settings'));

    }

    public function fetchShopifyProductNames($shop, $productGids) {

        if (empty($productGids)) {
            return [];
        }

        $gidsString = implode('","', $productGids);
    
        $query = <<<GRAPHQL
            {
                nodes(ids: ["$gidsString"]) {
                    ... on Product {
                        id
                        title
                    }
                }
            }
            GRAPHQL;

        $response = $shop->api()->graph($query);    
      
        $shopifyProducts = $response['body']['data']['nodes'] ?? [];


        // Extract product names
        $products = [];
        foreach ($shopifyProducts as $product) {
            if (!empty($product['id']) && !empty($product['title'])) {
                $products[$product['id']] = $product['title'];
            }
        }

        return $products;
    }

    public function fetchShopifyCollectionNames($shop, $collectionGids) {
        if (empty($collectionGids)) {
            return [];
        }
    
        $cidsString = implode('","', $collectionGids);
    
        $query = <<<GRAPHQL
            {
                nodes(ids: ["$cidsString"]) {
                    ... on Collection {
                        id
                        title
                    }
                }
            }
        GRAPHQL;
    
        $response = $shop->api()->graph($query);    
    
        $shopifyCollections = $response['body']['data']['nodes'] ?? [];
    
        // Extract collection names
        $collections = [];
        foreach ($shopifyCollections as $collection) {
            if (!empty($collection['id']) && !empty($collection['title'])) {
                $collections[$collection['id']] = $collection['title'];
            }
        }
    
        return $collections;
    }
    
    



    public function fetchUserTags(Request $request)
    {
        $shop = Auth::user();
    
        if (!$shop) {
            return response()->json(['error' => 'Shop is not authenticated.'], 401);
        }
    
        $searchTerm = $request->input('search', '');
    
        $query = <<<GRAPHQL
        {
            customers(first: 50, query: "tag:$searchTerm") {
                edges {
                    node {
                        tags
                    }
                }
            }
        }
        GRAPHQL;
    
        $response = $shop->api()->graph($query);
    
        // Extract customer nodes
        $customers = $response['body']['data']['customers']['edges'] ?? [];
    
        $tags = [];
    
        foreach ($customers as $customer) {
            $customerArray = $customer->toArray();
            
            if (!empty($customerArray['node']['tags']) && is_array($customerArray['node']['tags'])) {
                foreach ($customerArray['node']['tags'] as $tag) {
                    if (stripos($tag, $searchTerm) !== false) {
                        $tags[] = $tag;
                    }
                }
            }
        }
    
        // Remove duplicates & reset keys
        $tags = array_values(array_unique($tags));
    
        return response()->json(['tags' => $tags]);
    }
    

    public function fetchProduct(Request $request)
    {
        $shop = Auth::user();

        if (!$shop) {
            return response()->json(['error' => 'Shop is not authenticated.'], 401);
        }

        $searchTerm = $request->input('search', '');

                $query = <<<GRAPHQL
            {
                products(first: 5, query: "title:$searchTerm*") {
                    edges {
                        node {
                            id
                            title
                        }
                    }
                }
            }
            GRAPHQL;

        // Shopify API Call
        $response = $shop->api()->graph($query);

        // Extract products
        $shopifyProducts = $response['body']['data']['products']['edges'] ?? [];

        // Format response for Select2
        $products = [];
        foreach ($shopifyProducts as $product) {
            $node = $product['node'];
            $products[] = [
                'id' => $node['id'],
                'text' => $node['title'],
            ];
        }

        return response()->json(['results' => $products]);
    }

    public function fetchCollection(Request $request)
    {
        $shop = Auth::user();

        if (!$shop) {
            return response()->json(['error' => 'Shop is not authenticated.'], 401);
        }

        $searchTerm = $request->input('search', '');

        $query = <<<GRAPHQL
        {
            collections(first: 5, query: "title:$searchTerm*") {
                edges {
                    node {
                        id
                        title
                    }
                }
            }
        }
        GRAPHQL;

        $response = $shop->api()->graph($query);
        $shopifyCollections = $response['body']['data']['collections']['edges'] ?? [];

        // Format response for Select2
        $collections = [];
        foreach ($shopifyCollections as $collection) {
            $node = $collection['node'];
            $collections[] = [
                'id' => $node['id'],
                'text' => $node['title'],
            ];
        }

        return response()->json(['results' => $collections]);
    }


    public function fetchTags(Request $request)
    {
        $shop = Auth::user();

        if (!$shop) {
            return response()->json(['error' => 'Shop is not authenticated.'], 401);
        }

        $searchTerm = $request->input('search', '');

        $query = <<<GRAPHQL
        {
            products(first: 10, query: "tag:$searchTerm*") {
                edges {
                    node {
                        tags
                    }
                }
            }
        }
        GRAPHQL;
        $response = $shop->api()->graph($query);

        $shopifyTags = [];
        foreach ($response['body']['data']['products']['edges'] ?? [] as $product) {
            foreach ($product['node']['tags'] as $tag) {
                if (!in_array($tag, $shopifyTags)) {
                    $shopifyTags[] = $tag;
                }
            }
        }

        // Format response for Select2
        $tags = array_map(function ($tag) {
            return ['id' => $tag, 'text' => $tag];
        }, $shopifyTags);

        return response()->json(['results' => $tags]);
    }

    public function isSaleEnable(Request $request){

        $shop = Auth::user()->name;
        $existingRecord = RoleRestriction::where('shopName', $shop)->first();

        if ($existingRecord && $existingRecord->shopName !== $shop) {
            return response()->json([
                'status' => 404,
                'message' => 'User is not validated',
            ], 404);
        }


        $request->validate([
            'isEnable' => 'required|boolean',
        ]);

        $setting = GeneralSetting::updateOrCreate(
            ['shopName' => $shop],
            [
                'shopName' => $shop,
                'isEnable' => $request->isEnable
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Setting Updated Successfully!',
        ]);

    }

    public function storeRoleRestrictionForm(Request $request){
            try{
                $shop = Auth::user()->name;

                $existingRecord = RoleRestriction::where('shopName', $shop)->first();

                if ($existingRecord && $existingRecord->shopName !== $shop) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'User is not validated',
                    ], 404);
                }


                $inputs = $request->all();

                $validatedData = $request->validate([
                'sale_type' => 'required|boolean',
                'sale_amount' => 'required',
                'start_date' => 'required',
                'start_time' => 'required',
                'end_date' => 'required',
                'end_time' => 'required',
                'isGuest' => 'required|boolean',
                'user_selection' => 'required|boolean',
                'specific_user_tags' => 'nullable|array',
                'product_selection' => 'required|boolean',
                'specific_products' => 'nullable|array',
                'include_collections' => 'nullable|array',
                'product_tags' => 'nullable|array',
                ]);


                $data = RoleRestriction::updateOrCreate(
                    ['shopName' => $shop],
                    array_merge($validatedData, ['shopName' => $shop])
                );

                if ($request->user_selection == 1) {
                    $data->specific_user_tags = null;
                }
                
                if ($request->product_selection == 1) {
                    $data->specific_products = null;
                    $data->include_collections = null;
                }
                
                if ($request->user_selection == 1 || $request->product_selection == 1) {
                    $data->save();
                }
                


                return response()->json([
                    'success' => true,
                    'message' => 'Setting Updated Successfully!',
                ]);

            } catch (Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'An error occurred while saving the record',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function notiificationSettings(Request $request){

        $shopName = Auth::user()->name;
        $existingRecord = NotificationSetting::where('shopName', $shopName)->first();

        if ($existingRecord && $existingRecord->shopName !== $shopName) {
            return response()->json([
                'status' => 404,
                'message' => 'User is not validated',
            ], 404);
        }

        $validated = $request->validate([
            'is_top_bar_enable' => 'required|boolean',
            'notification_content' => 'required',
            'notification_bg_color' => 'required',
            'notification_color' => 'required',
            'is_popup_enable' => 'required|boolean',
            'popup_content' => 'required',
            'popup_bg_color' => 'required',
            'popup_color' => 'required',
        ]);

        $notification_settings = NotificationSetting::updateOrCreate(
            ['shopName' => $shopName],
            array_merge($validated, ['shopName' => $shopName])
           
        );
    
        return response()->json([
            'success' => true,
            'message' => 'Notification settings updated successfully!',
        ]);



    }


}