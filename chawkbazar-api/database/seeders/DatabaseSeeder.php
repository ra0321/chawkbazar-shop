<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Marvel\Database\Models\Attribute;
use Marvel\Database\Models\AttributeValue;
use Marvel\Database\Models\Product;
use Marvel\Database\Models\User;
use Marvel\Database\Models\Category;
use Marvel\Database\Models\Type;
use Marvel\Database\Models\Order;
use Marvel\Database\Models\OrderStatus;
use Marvel\Database\Models\Coupon;
use Spatie\Permission\Models\Permission;
use Marvel\Enums\Permission as UserPermission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // run your app seeder
    }
}
