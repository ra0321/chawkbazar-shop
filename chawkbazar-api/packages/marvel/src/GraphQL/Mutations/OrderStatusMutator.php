<?php


namespace Marvel\GraphQL\Mutation;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Marvel\Http\Controllers\OrderStatusController;
use Marvel\Facades\Shop;

class OrderStatusMutator
{

    public function store($rootValue, array $args, GraphQLContext $context)
    {

        // Do graphql stuff
        return Shop::call('Marvel\Http\Controllers\OrderStatusController@store', $args);
    }
}
