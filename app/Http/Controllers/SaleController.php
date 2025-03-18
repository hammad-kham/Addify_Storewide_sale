<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function fetchUser(Request $request)
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


}
