<?php

namespace App\Http\Controllers;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CategoriesExport;
use App\Models\Magasin;

// use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Initialize the query builder for the Categorie model
        $query = Categorie::query();
        $categories = $query->paginate(10);
        $magasins = Magasin::all();

        // Return the Inertia.js response with the categories data and any success message from the session
        return inertia('Categorie/Index', [
            'categories' => CategorieResource::collection($categories),
            'magasins' => $magasins,
            'success' => session('success'),
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Categorie/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $data=$request->all();
        // dd($data['type'],$data['id_magasin']);
        Categorie::create($data);

        return to_route('categorie.index')->with('success', 'La catégorie a été créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)

    {

        return inertia('Categorie/Edit',[
            'categorie' => $categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $data= $request->all();

        $categorie->update($data);
        return to_route('categorie.index')->with('success','La catégorie a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return to_route('categorie.index')->with('success', 'La catégorie a été supprimée avec succès');
    }




    public function exportPdf()
    {
        $categories = Categorie::get();


        $pdf = Pdf::loadView('pdf.categories', ['categories' => $categories]);



        $pdf = Pdf::loadView('pdf.categories', ['categories' => $categories]);




        return $pdf->download('categories.pdf');

    }











    public function exportExcel()
    {
        $categories = Categorie::get();
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }

}
