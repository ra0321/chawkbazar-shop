<?php

namespace Marvel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Marvel\Database\Repositories\AddressRepository;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Marvel\Database\Models\Product;
use Marvel\Database\Models\Shop;
use Marvel\Enums\Permission;
use Marvel\Exceptions\MarvelException;
use Spatie\Permission\Models\Permission as ModelsPermission;

class AnalyticsController extends CoreController
{
    public $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }


    public function analytics(Request $request)
    {
        $user = $request->user();
        if ($user && ($user->hasPermissionTo(Permission::SUPER_ADMIN) || $user->hasPermissionTo(Permission::STORE_OWNER))) {
            $totalRevenueQuery = DB::table('orders')->whereDate('created_at', '>', Carbon::now()->subDays(30));
            if ($user && $user->hasPermissionTo(Permission::SUPER_ADMIN)) {
                $totalRevenue = $totalRevenueQuery->where('parent_id', null)->sum('paid_total');
            } else {
                $totalRevenue = $totalRevenueQuery->where('shop_id', '=', $user->id)->sum('paid_total');
            }

            $todaysRevenueQuery = DB::table('orders')->whereDate('created_at', '>', Carbon::now()->subDays(1));

            if ($user && $user->hasPermissionTo(Permission::SUPER_ADMIN)) {
                $todaysRevenue = $todaysRevenueQuery->where('parent_id', null)->sum('paid_total');
            } else {
                $todaysRevenue = $todaysRevenueQuery->where('shop_id', '=', $user->id)->sum('paid_total');
            }
            $totalOrdersQuery = DB::table('orders')->whereDate('created_at', '>', Carbon::now()->subDays(30));
            if ($user && $user->hasPermissionTo(Permission::SUPER_ADMIN)) {
                $totalOrders = $totalOrdersQuery->where('parent_id', null)->count();
            } else {
                $totalOrders = $totalOrdersQuery->where('shop_id', '=', $user->id)->count();
            }
            if ($user && $user->hasPermissionTo(Permission::SUPER_ADMIN)) {
                $totalShops = Shop::count();
            } else {
                $totalShops = Shop::where('owner_id', '=', $user->id)->count();
            }
            $customerPermission = ModelsPermission::where('name', Permission::CUSTOMER)->first();
            $newCustomers = $customerPermission->users()->whereDate('created_at', '>', Carbon::now()->subDays(30))->count();
            $totalYearSaleByMonthQuery =
                DB::table('orders')->selectRaw(
                    "sum(paid_total) as total, DATE_FORMAT(created_at,'%M') as month"
                )->whereYear('created_at', date('Y'));
            if ($user && $user->hasPermissionTo(Permission::SUPER_ADMIN)) {
                $totalYearSaleByMonth = $totalYearSaleByMonthQuery->where('parent_id', null)->groupBy('month')->get();
            } else {
                $totalYearSaleByMonth = $totalYearSaleByMonthQuery->where('shop_id', '=', $user->id)->groupBy('month')->get();
            }

            $months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];

            $processedData = [];

            foreach ($months as $key => $month) {
                foreach ($totalYearSaleByMonth as $value) {
                    if ($value->month === $month) {
                        $processedData[$key] = $value;
                    }
                }
            }
            foreach ($months as $key => $month) {
                if (!isset($processedData[$key])) {
                    $processedData[$key] = ['total' => 0, 'month' => $month];
                }
            }
            ksort($processedData);
            return [
                'totalRevenue' => $totalRevenue,
                'totalShops' => $totalShops,
                'todaysRevenue' => $todaysRevenue,
                'totalOrders' => $totalOrders,
                'newCustomers' =>  $newCustomers,
                'totalYearSaleByMonth' => $processedData
            ];
        }
        throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.NOT_AUTHORIZED');
    }

    public function popularProducts(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $products_query = Product::withCount('orders')->with(['type', 'shop'])->orderBy('orders_count', 'desc')->limit($limit);
        if (isset($request->shop_id)) {
            $products = $products_query->where('shop_id', "=", $request->shop_id)->get();
        } else {
            $products = $products_query->get();
        }

        return $products;
    }
}
