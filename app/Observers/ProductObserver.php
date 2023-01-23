<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\LogDetail;
use Auth;
use Carbon\Carbon;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'quantity' => $product->quantity,
            'price' => $product->price,
        ];

        LogDetail::insert(
            [
                'data' => json_encode($productData),
                'product_id' => $product->id,
                'activity' => 'Created',
                'causer' => Auth::user()->name,
                'created_at' => Carbon::now(),
            ]
        );

    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'quantity' => $product->quantity,
            'price' => $product->price,
        ];

        LogDetail::insert(
            [
                'data' => json_encode($productData),
                'product_id' => $product->id,
                'activity' => 'Updated',
                'causer' => Auth::user()->name,
                'created_at' => Carbon::now(),
            ]
        );
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'quantity' => $product->quantity,
            'price' => $product->price,
        ];

        LogDetail::insert(
            [
                'data' => json_encode($productData),
                'product_id' => $product->id,
                'activity' => 'Deleted',
                'causer' => Auth::user()->name,
                'created_at' => Carbon::now(),
            ]
        );
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'quantity' => $product->quantity,
            'price' => $product->price,
        ];

        LogDetail::insert(
            [
                'data' => json_encode($productData),
                'product_id' => $product->id,
                'activity' => 'Restored',
                'causer' => Auth::user()->name,
                'created_at' => Carbon::now(),
            ]
        );
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'quantity' => $product->quantity,
            'price' => $product->price,
        ];

        LogDetail::insert(
            [
                'data' => json_encode($productData),
                'product_id' => $product->id,
                'activity' => 'Permanent Deleted',
                'causer' => Auth::user()->name,
                'created_at' => Carbon::now(),
            ]
        );
    }
}
