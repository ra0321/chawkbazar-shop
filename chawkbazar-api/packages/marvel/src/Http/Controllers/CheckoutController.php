<?php

namespace Marvel\Http\Controllers;

use Marvel\Database\Repositories\CheckoutRepository;
use Marvel\Http\Requests\CheckoutVerifyRequest;
use Marvel\Enums\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Marvel\Exceptions\MarvelException;

class CheckoutController extends CoreController
{
    public $repository;

    public function __construct(CheckoutRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Verify the checkout data and calculate tax and shipping.
     *
     * @param CheckoutVerifyRequest $request
     * @return array
     */
    public function verify(CheckoutVerifyRequest $request)
    {
        $user = $request->user();
        if ($user->can(Permission::CUSTOMER)) {
            return $this->repository->verify($request);
        } else {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.NOT_AUTHORIZED');
        }
    }
}
