<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // listar serviços
    public function index()
    {
        $services = Service::orderBy('name')->paginate(12);
        return view('services.index', compact('services'));
    }

    // mostrar formulário de criação
    public function create()
    {
        return view('services.create');
    }

    // salvar novo serviço
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sla' => 'nullable|string|max:255',
            'results_expected' => 'nullable',
        ]);

        // se results_expected veio como texto (ex: textarea), tenta decodificar
        if ($request->filled('results_expected') && is_string($request->results_expected)) {
            $decoded = json_decode($request->results_expected, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['results_expected'] = $decoded;
            } else {
                // permitir enviar via textarea como linhas separadas
                $lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $request->results_expected)));
                if (! empty($lines)) {
                    $data['results_expected'] = array_values($lines);
                }
            }
        }

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'serviço criado.');
    }

    // mostrar detalhe do serviço
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // formulário de edição
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    // atualizar serviço
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sla' => 'nullable|string|max:255',
            'results_expected' => 'nullable',
        ]);

        if ($request->filled('results_expected') && is_string($request->results_expected)) {
            $decoded = json_decode($request->results_expected, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['results_expected'] = $decoded;
            } else {
                $lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $request->results_expected)));
                if (! empty($lines)) {
                    $data['results_expected'] = array_values($lines);
                }
            }
        }

        $service->update($data);

        return redirect()->route('services.show', $service)->with('success', 'serviço atualizado.');
    }

    // remover serviço
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'serviço removido.');
    }
}
