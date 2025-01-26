<?php

namespace App\Http\Controllers;

use App\RepositoryContract;
use Illuminate\Http\Request;

class RubricaController extends Controller
{
    private RepositoryContract $repo;

    public function __construct(RepositoryContract $repo){

        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repo->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return a form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->repo->save([]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repo->get($id);
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
        $this->repo->delete($id);
    }
}
