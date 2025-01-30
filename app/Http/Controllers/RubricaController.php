<?php

namespace App\Http\Controllers;

use MyApp\Facade\RepositoryContractFacade;
use Illuminate\Http\Request;

class RubricaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RepositoryContractFacade::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RepositoryContractFacade::save([]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return RepositoryContractFacade::save([]);
        //return $this->repo->save([]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return RepositoryContractFacade::get($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return RepositoryContractFacade::delete($id);
    }
}
