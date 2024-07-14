<?php

namespace App\Http\Controllers;

use App\Models\Clube;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClubeRequest;
use App\Http\Requests\UpdateClubeRequest;

class ClubeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Clube::query();
        $columns = ['nome', 'distrito', 'igreja'];
        $orderby = 'nome';
        $paginate = 10;

        if ($request->filled('area')) {
            $query->where('area', $request->area );
        }

        if ($request->filled('regiao')) {
            $query->where('regiao', $request->regiao);
        }

        if ($request->filled('nome')) {
            $query->where(function ($query) use ($request, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $request->nome . '%');
                }
            });
        }

        $clubes = $query->orderBy($orderby, 'asc')->paginate($paginate);

        return view('clubes.index', compact('clubes'));
    }

    public function create()
    {
        return view('clubes.create');
    }

    public function store(StoreClubeRequest $request)
    {
        Clube::create($request->validated());

        return redirect()->route('clubes.index')
            ->with('success', 'Clube criado com sucesso.');
    }

    public function show(Clube $clube)
    {
        return view('clubes.show', compact('clube'));
    }

    public function edit(Clube $clube)
    {
        return view('clubes.edit', compact('clube'));
    }

    public function update(UpdateClubeRequest $request, Clube $clube)
    {
        $clube->update($request->validated());

        return redirect()->route('clubes.index')
            ->with('success', 'Clube atualizado com sucesso.');
    }

    public function destroy(Clube $clube)
    {
        $clube->delete();

        return redirect()->route('clubes.index')
            ->with('success', 'Clube deletado com sucesso.');
    }
}
