<?php

namespace MyApp\Facade;

use Illuminate\Support\Facades\Facade;
use MyApp\RepositoryContract;

/**
 * @method static all()
 * @method static save( array $array )
 * @method static get( string $id )
 * @method static delete( string $id )
 */
class RepositoryContractFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return RepositoryContract::class;
    }
}
