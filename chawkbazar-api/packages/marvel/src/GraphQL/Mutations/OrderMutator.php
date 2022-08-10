<?php


namespace Marvel\GraphQL\Mutation;

use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Marvel\Exceptions\MarvelException;
use Marvel\Facades\Shop;

class OrderMutator
{

    public function store($rootValue, array $args, GraphQLContext $context)
    {
        try {
            return Shop::call('Marvel\Http\Controllers\OrderController@store', $args);
        } catch (\Exception $e) {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.SOMETHING_WENT_WRONG');
        }
    }
    public function update($rootValue, array $args, GraphQLContext $context)
    {
        try {
            return Shop::call('Marvel\Http\Controllers\OrderController@updateOrder', $args);
        } catch (\Exception $e) {
            throw new MarvelException(config('shop.app_notice_domain') . 'ERROR.SOMETHING_WENT_WRONG');
        }
    }
}
