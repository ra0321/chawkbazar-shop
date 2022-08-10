<?php

namespace Marvel\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;


class ImportDemoData extends Command
{
    protected $signature = 'marvel:seed';

    protected $description = 'Import Demo Data';

    public function handle()
    {

        $this->info('Copying necessary files for seeding....');

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/sql/' . config('shop.dummy_data_path'), public_path('sql'));

        $this->info('File copying successful');

        $this->info('Seeding....');

        $this->seedDemoData();
    }
    public function seedDemoData()
    {
        $media_path = public_path('sql/media.sql');
        $media_sql = file_get_contents($media_path);
        DB::statement($media_sql);

        $attachments_path = public_path('sql/attachments.sql');
        $attachments_sql = file_get_contents($attachments_path);
        DB::statement($attachments_sql);

        $permissions_path = public_path('sql/permissions.sql');
        $permissions_sql = file_get_contents($permissions_path);
        DB::statement($permissions_sql);

        $types_path = public_path('sql/types.sql');
        $types_sql = file_get_contents($types_path);
        DB::statement($types_sql);

        // For ChawkBazar
        $types_path = public_path('sql/tags.sql');
        $types_sql = file_get_contents($types_path);
        DB::statement($types_sql);

        // For chawkbazar
        // $banners_path = public_path('sql/banners.sql');
        // $banners_sql = file_get_contents($banners_path);
        // DB::statement($banners_sql);

        $users_path = public_path('sql/users.sql');
        $users_sql = file_get_contents($users_path);
        DB::statement($users_sql);

        $user_profiles_path = public_path('sql/user_profiles.sql');
        $user_profiles_sql = file_get_contents($user_profiles_path);
        DB::statement($user_profiles_sql);

        $address_path = public_path('sql/address.sql');
        $address_sql = file_get_contents($address_path);
        DB::statement($address_sql);

        $model_has_permissions_path = public_path('sql/model_has_permissions.sql');
        $model_has_permissions_sql = file_get_contents($model_has_permissions_path);
        DB::statement($model_has_permissions_sql);

        $shops_path = public_path('sql/shops.sql');
        $shops_sql = file_get_contents($shops_path);
        DB::statement($shops_sql);

        $balances_path = public_path('sql/balances.sql');
        $balances_sql = file_get_contents($balances_path);
        DB::statement($balances_sql);

        $attributes_path = public_path('sql/attributes.sql');
        $attributes_sql = file_get_contents($attributes_path);
        DB::statement($attributes_sql);

        $attribute_values_path = public_path('sql/attribute_values.sql');
        $attribute_values_sql = file_get_contents($attribute_values_path);
        DB::statement($attribute_values_sql);

        $categories_path = public_path('sql/categories.sql');
        $categories_sql = file_get_contents($categories_path);
        DB::statement($categories_sql);

        $products_path = public_path('sql/products.sql');
        $products_sql = file_get_contents($products_path);
        DB::statement($products_sql);

        $attribute_product_path = public_path('sql/attribute_product.sql');
        $attribute_product_sql = file_get_contents($attribute_product_path);
        DB::statement($attribute_product_sql);

        $variation_options_path = public_path('sql/variation_options.sql');
        $variation_options_sql = file_get_contents($variation_options_path);
        DB::statement($variation_options_sql);

        $coupons_path = public_path('sql/coupons.sql');
        $coupons_sql = file_get_contents($coupons_path);
        DB::statement($coupons_sql);

        $orders_status_path = public_path('sql/order_status.sql');
        $orders_status_sql = file_get_contents($orders_status_path);
        DB::statement($orders_status_sql);

        // For ChawkBazar
        $types_path = public_path('sql/product_tag.sql');
        $types_sql = file_get_contents($types_path);
        DB::statement($types_sql);

        $category_product_path = public_path('sql/category_product.sql');
        $category_product_sql = file_get_contents($category_product_path);
        DB::statement($category_product_sql);

        $orders_path = public_path('sql/orders.sql');
        $orders_sql = file_get_contents($orders_path);
        DB::statement($orders_sql);

        $order_product_path = public_path('sql/order_product.sql');
        $order_product_sql = file_get_contents($order_product_path);
        DB::statement($order_product_sql);

        $settings_path = public_path('sql/settings.sql');
        $settings_sql = file_get_contents($settings_path);
        DB::statement($settings_sql);

        $shipping_classes_path = public_path('sql/shipping_classes.sql');
        $shipping_classes_sql = file_get_contents($shipping_classes_path);
        DB::statement($shipping_classes_sql);

        $tax_classes_path = public_path('sql/tax_classes.sql');
        $tax_classes_sql = file_get_contents($tax_classes_path);
        DB::statement($tax_classes_sql);

        $withdraws_path = public_path('sql/withdraws.sql');
        $withdraws_sql = file_get_contents($withdraws_path);
        DB::statement($withdraws_sql);

        $this->info('Seed completed successfully!');
    }
}
