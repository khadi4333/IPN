<?php

namespace App\Http\Controllers;

use App\Models\CatelogueProduit;
use App\Http\Requests\StoreCatelogueProduitRequest;
use App\Http\Requests\UpdateCatelogueProduitRequest;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\CatelogueResource;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;



class CatelogueProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = CatelogueProduit::query();

        // Execute the query with pagination
        $Produits = $query->paginate(10);
        $categories = Categorie::all();

        return inertia('CatelogueProduit/Index', [
            'produits' => CatelogueResource::collection($Produits),
            'categories' => CategorieResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatelogueProduitRequest $request)
    {
        $data = $request->all();
        $data['stock'] = 0; // Initialiser le stock à 0
        CatelogueProduit::create($data);

        return to_route('catelogueProduit.index')->with('success', "Le produit a été créé avec succès");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatelogueProduitRequest $request, CatelogueProduit $catelogueProduit)
    {
        $data = $request->all();
        $catelogueProduit->update($data);
        return to_route('catelogueProduit.index')->with('success', "Le produit a été mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatelogueProduit $catelogueProduit)
    {
        $catelogueProduit->delete();
        return to_route('catelogueProduit.index')->with('success', 'Le produit a été supprimé avec succès');
    }
}
