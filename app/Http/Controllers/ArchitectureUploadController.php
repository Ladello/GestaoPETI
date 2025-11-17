<?php

namespace App\Http\Controllers;

use App\Models\ArchitectureUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchitectureUploadController extends Controller
{
    // listar uploads
    public function index()
    {
        $uploads = ArchitectureUpload::with('uploader')->orderBy('created_at','desc')->paginate(12);
        return view('architecture.index', compact('uploads'));
    }

    // formulário de upload
    public function create()
    {
        return view('architecture.create');
    }

    // armazenar upload
    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg,svg|max:10240', // max 10 MB
            'description' => 'nullable|string|max:2000',
        ]);

        // armazenar no disco public dentro de /architecture
        $path = $request->file('file')->store('architecture', 'public');

        $upload = ArchitectureUpload::create([
            'filename' => $path, // caminho no storage (ex: architecture/abcd1234.pdf)
            'mime' => $request->file('file')->getClientMimeType(),
            'uploaded_by' => auth()->id(),
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('architecture.index')->with('success', 'arquivo enviado.');
    }

    // mostrar detalhe do upload
    public function show(ArchitectureUpload $architecture)
    {
        $architecture->load('uploader');
        return view('architecture.show', ['upload' => $architecture]);
    }

    // download/visualizar diretamente
    public function download(ArchitectureUpload $architecture)
    {
        // path salvo em filename
        $path = $architecture->filename;

        if (! Storage::disk('public')->exists($path)) {
            return redirect()->back()->with('error', 'arquivo não encontrado no servidor.');
        }

        // forçar download com nome original simples (usa basename do path salvo)
        $original = basename($path);
        return Storage::disk('public')->download($path, $original);
    }

    // deletar upload (remove do storage e do banco)
    public function destroy(ArchitectureUpload $architecture)
    {
        $path = $architecture->filename;

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $architecture->delete();

        return redirect()->route('architecture.index')->with('success', 'arquivo removido.');
    }
}
