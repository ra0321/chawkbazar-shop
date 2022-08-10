<?php


namespace Marvel\Database\Repositories;

use Exception;
use Marvel\Database\Models\Address;
use Marvel\Database\Models\Order;
use Marvel\Database\Models\Refund;
use Marvel\Exceptions\MarvelException;

class RefundRepository extends BaseRepository
{
    protected $dataArray = [
        'order_id',
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Refund::class;
    }

    public function storeRefund($request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
        } catch (Exception $th) {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.NOT_FOUND');
        }
        if (count($order->children)) {
            $data = $request->only($this->dataArray);
            $data['customer_id'] = $order->customer_id;
            $data['shop_id'] = $order->shop_id;
            $data['amount'] = $order->paid_total - $order->delivery_fee;
            $refund = $this->create($data);
            $this->createChildOrderRefund($order->children);
            return $refund;
        } else {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.ONLY_PARENT_ORDER_IS_ALLOWED_FOR_REFUND');
        }
    }

    public function createChildOrderRefund($orders)
    {
        try {
            foreach ($orders as  $order) {
                $data['order_id'] = $order->id;
                $data['customer_id'] = $order->customer_id;
                $data['shop_id'] = $order->shop_id;
                $data['amount'] = $order->paid_total;
                $this->create($data);
            }
        } catch (Exception $th) {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.SOMETHING_WENT_WRONG');
        }
    }

    public function updateRefund($request, $refund)
    {
        $refund->update($request->only($this->dataArray));
        return $refund;
    }
}
