<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Docs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Auth;

class DocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Docs::all();
        return view('docs.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        return view('docs.create');
    }

    public function delete($doc)
    {
        $docs = Docs::find($doc);
        
        $docs->delete();   
        
        return back()->with('success', 'Documento EXCLUÍDO com sucesso!');

    }

    public function delete_massa_docs(Request $request)
    {
        //Log::info("DELETE endpoint accessed"); // Adiciona um log para saber se o controlador foi acessado
        
        $ids = $request->input('ids');
        //Log::info('IDs received for deletion:', ['ids' => $ids]); // Para depuração

        if ($ids && is_array($ids)) {
            Docs::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No IDs provided'], 400); // Erro se a lista estiver vazia ou não for um array
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //exit;
        // Handle File Upload
        if($request->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
            // Upload Image
            $path = $request->file('arquivo')->storeAs('/docs', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        //save in database
        $docs = Docs::create([
            'dt' => now(),
            'obs' => $request->obs,
            'doc' => $fileNameToStore
        ]);
        $realPath = storage_path('app/public');
        chmod($realPath, 0755);
        
        return redirect()
                    ->route('docs.index')
                    ->with('success', 'Documento inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download_doc($doc)
    {
        //dd($doc);
        //exit;

        $docs = Docs::find($doc);
    
        return Storage::download('docs/'.$docs->doc);
        
    }
}
