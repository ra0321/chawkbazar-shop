<?php


namespace Marvel\Database\Repositories;

use Illuminate\Support\Facades\Log;
use Marvel\Database\Models\Coupon;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class CouponRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code'        => 'like',
    ];

    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coupon::class;
    }

    public function verifyCoupon($code)
    {
        try {
            $coupon = $this->findOneByFieldOrFail('code', $code);
            if ($coupon->is_valid) {
                return  ["is_valid" => true, "coupon" => $coupon];
            }
            return  ["is_valid" => false];
        } catch (\Exception $th) {
            return  ["is_valid" => false];
        }
    }
}
