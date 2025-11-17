@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Dashboard</h2>
    <div class="text-end small text-muted">visão geral do PETI • {{ now()->format('d/m/Y H:i') }}</div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card p-3 h-100">
      <div class="small text-muted">projetos</div>
      <h3 class="mb-0">{{ $totalProjects }}</h3>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 h-100">
      <div class="small text-muted">atividades</div>
      <h3 class="mb-0">{{ $totalActivities }}</h3>
      <div class="small text-danger">{{ $overdueActivities }} atrasadas</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 h-100">
      <div class="small text-muted">serviços</div>
      <h3 class="mb-0">{{ $totalServices }}</h3>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 h-100">
      <div class="small text-muted">objetivos / metas</div>
      <h3 class="mb-0">{{ $totalObjectives }} / {{ $totalGoals }}</h3>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5>projetos por status</h5>
      <canvas id="projectsStatusChart" height="200"></canvas>
      <small class="text-muted">distribuição por status (dados atualizados em tempo real).</small>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5>últimas atividades</h5>
      <ul class="list-group list-group-flush mt-2">
        @forelse($recentActivities as $a)
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <strong>{{ $a->title }}</strong>
              <div class="small text-muted">{{ $a->project->title ?? '—' }}</div>
            </div>
            <div class="text-end small">
              <div class="mb-1 text-capitalize">{{ $a->status }}</div>
              <div class="text-muted">{{ $a->due_date ? $a->due_date->format('d/m/Y') : 'sem prazo' }}</div>
            </div>
          </li>
        @empty
          <li class="list-group-item">nenhuma atividade recente.</li>
        @endforelse
      </ul>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-6">
    <div class="card p-3">
      <h5>últimos projetos</h5>
      <ul class="list-group list-group-flush mt-2">
        @forelse($recentProjects as $p)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>{{ $p->title }}</strong>
              <div class="small text-muted">{{ Str::limit($p->description, 80) }}</div>
            </div>
            <div class="text-end">
              <span class="badge bg-secondary text-capitalize">{{ $p->status }}</span>
              <div class="small text-muted">{{ $p->created_at->format('d/m/Y') }}</div>
            </div>
          </li>
        @empty
          <li class="list-group-item">nenhum projeto recente.</li>
        @endforelse
      </ul>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card p-3">
      <h5>atalhos rápidos</h5>
      <div class="d-grid gap-2">
        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">Gerenciar Projetos</a>
        <a href="{{ route('canvas.index') }}" class="btn btn-outline-secondary">Abrir Canvas</a>
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">Serviços</a>
        <a href="{{ route('objectives.index') }}" class="btn btn-outline-secondary">Objetivos</a>
        <a href="{{ route('architecture.index') }}" class="btn btn-outline-secondary">Arquitetura</a>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<!-- chart.js CDN (não precisa de node) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // dados vindos do controller
    const labels = {!! json_encode($chartLabels) !!};
    const values = {!! json_encode($chartValues) !!};

    // se não houver dados, evita erro
    if (labels.length === 0) {
        document.getElementById('projectsStatusChart').parentElement.insertAdjacentHTML('beforeend','<p class="small text-muted mt-2">nenhum projeto cadastrado.</p>');
        return;
    }

    const ctx = document.getElementById('projectsStatusChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels.map(l => l.replace(/_/g, ' ')),
            datasets: [{
                label: 'Projetos por status',
                data: values,
                backgroundColor: [
                    '#0d6efd','#198754','#ffc107','#dc3545','#6c757d','#6610f2','#0dcaf0'
                ],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
</script>
@endpush
