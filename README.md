## GestaoPETI

GestaoPETI é um sistema web para apoiar a **gestão de PETI (Plano Estratégico de TI)** em organizações. 

Ele centraliza o acompanhamento de projetos, atividades, serviços de TI, objetivos/metas, princípios de arquitetura e canvas estratégico, oferecendo uma visão consolidada no dashboard.

O projeto foi desenvolvido em **Laravel** e utiliza **Blade**, **Bootstrap 5** e **MySQL**.

---

## Funcionalidades principais

### 1. Dashboard

Página inicial após o login, com uma visão geral do PETI:

- Contadores de:
  - Projetos
  - Atividades (com destaque para atividades atrasadas)
  - Serviços
  - Objetivos / Metas
- Gráfico "Projetos por status" (doughnut), usando **Chart.js**, exibindo a distribuição dos projetos em estados como `proposta`, `planejado`, `em_andamento`, `concluido`, etc.
- Lista de **últimas atividades**, com:
  - Título
  - Projeto relacionado
  - Status
  - Data de vencimento
- Lista de **últimos projetos** cadastrados.
- Bloco de **atalhos rápidos** para as principais áreas do sistema:
  - Gerenciar Projetos
  - Abrir Canvas
  - Serviços
  - Objetivos
  - Arquitetura

---

### 2. Projetos

Módulo para gerenciar o portfólio de projetos de TI.

**Model:** `App\Models\Project`

**Campos principais:**

- `title` – nome do projeto
- `description` – descrição/justificativa
- `status` – ciclo de vida do projeto (`proposta`, `planejado`, `em_andamento`, `cancelado`, `concluido`, `liberado`, `em_operacao`, `aposentado`)
- `priority` – prioridade (`baixa`, `media`, `alta`)
- `start_date` / `end_date` – datas de início e fim
- `owner_id` – usuário responsável (relacionamento com `User`)
- `meta` – campo JSON para metas/indicadores ligados ao projeto

**Funcionalidades:**

- CRUD completo de projetos (`ProjectController`).
- Listagem com filtros (status, prioridade, busca por título/descrição).
- Exibição do **responsável** pelo projeto (`owner`).
- Página de detalhes com atividades relacionadas.
- Ação rápida para **mudar status** do projeto.

---

### 3. Atividades

Módulo de atividades vinculadas a projetos.

**Model:** `App\Models\Activity`

Cada atividade pertence a um `Project` e pode ter responsável próprio, status e data de vencimento.

**Funcionalidades:**

- Cadastro/edição de atividades de um projeto.
- Relacionamento com projeto e (opcionalmente) com usuário responsável.
- Destaque para atividades atrasadas no dashboard.

---

### 4. Serviços de TI

Módulo para gerenciar o **portfólio de serviços de TI** ofertados para o negócio.

**Model:** `App\Models\Service`

**Campos principais:**

- `name` – nome do serviço
- `description` – descrição
- `sla` – nível de serviço / SLA
- `results_expected` – resultados de negócio esperados (campo JSON, preenchido via texto ou JSON no formulário)

**Funcionalidades:**

- CRUD completo de serviços (`ServiceController`).
- Tela de listagem com ações de **ver**, **editar** e **excluir**.
- Interpretação flexível de `results_expected` (texto em múltiplas linhas ou JSON).

---

### 5. Objetivos e Metas

Representam o desdobramento do planejamento estratégico de TI.

**Models:**

- `App\Models\Objective`
- `App\Models\Goal`

**Objective:**

- `title` – objetivo estratégico
- `description` – detalhes
- `type` – tipo (`estrategico`, `tatico`, `operacional`)
- `requirements` – requisitos de negócio (salvos como array JSON a partir de texto multiline)

**Goal:**

- Metas associadas a um objetivo (`belongsTo(Objective)`).
- Campos para descrição, indicadores, valores de referência etc. (conforme migrations).

**Funcionalidades:**

- CRUD de objetivos (`ObjectiveController`).
- CRUD de metas (`GoalController`).
- Tela de detalhes do objetivo listando as metas vinculadas.

---

### 6. Princípios de Arquitetura

Módulo para registrar **princípios de arquitetura de TI** que orientam decisões.

**Model:** `App\Models\Principle`

**Funcionalidades:**

- CRUD de princípios (`PrincipleController`).
- Listagem, criação, edição e visualização de detalhes.

---

### 7. Canvas de TI

Implementação de um **Canvas de TI** (baseado em blocos) para representar visualmente o modelo PETI.

**Model:** `App\Models\CanvasItem`

Cada item representa um bloco (ex.: parcerias, atividades-chave, proposta de valor, etc.) com conteúdo e ordem.

**Funcionalidades:**

- Tela `canvas.index` exibindo o canvas em uma grade 3x3.
- Edição individual de cada bloco (`CanvasController@edit` / `update`).
- Remoção de blocos.
- Exportação do canvas para **PDF** (`canvas.pdf`), utilizando **barryvdh/laravel-dompdf**.

---

### 8. Arquitetura de TI (uploads)

Módulo para upload e gestão de artefatos de arquitetura (diagramas, documentos, PDFs, imagens).

**Model:** `App\Models\ArchitectureUpload`

**Funcionalidades:**

- Upload de arquivos para `storage/app/public`.
- Listagem de uploads com nome, descrição, tipo e usuário que enviou.
- Tela de detalhes com:
  - Download do arquivo.
  - Visualização inline para **imagens** e **PDF** (via `<iframe>`), quando suportado pelo navegador.

---

### 9. Autenticação e navegação

O sistema utiliza a autenticação do Laravel para restringir o acesso às funcionalidades.

- Tela de login simples em `resources/views/auth/login.blade.php`.
- Rotas protegidas por `Route::middleware('auth')` em `routes/web.php`.
- Layout principal `resources/views/layouts/app.blade.php` com:
  - Navbar para navegação entre módulos (Projetos, Canvas, Serviços, Objetivos, Princípios, Arquitetura).
  - Saudação com o nome do usuário autenticado.
  - Botão de **Sair** (`logout`).

---

## Arquitetura do projeto

O projeto segue a estrutura padrão do Laravel 10:

- `app/Models` – modelos Eloquent (Project, Activity, Service, Objective, Goal, Principle, CanvasItem, ArchitectureUpload, User).
- `app/Http/Controllers` – controladores REST responsáveis por cada módulo (ProjectController, ActivityController, ServiceController, ObjectiveController, GoalController, PrincipleController, CanvasController, ArchitectureUploadController, DashboardController).
- `database/migrations` – definem as tabelas `projects`, `activities`, `services`, `canvas_items`, `principles`, `objectives`, `goals`, `architecture_uploads`, `users`, etc.
- `resources/views` – views Blade organizadas por pasta de módulo (projects, activities, services, objectives, principles, canvas, architecture, dashboard, auth, layouts).
- `routes/web.php` – definição das rotas web, incluindo os recursos REST e rotas personalizadas (ex.: `canvas.pdf`, `projects.changeStatus`, `activities.changeStatus`, `architecture.download`).

Dependências principais:

- **PHP 8+**
- **Laravel** (framework principal)
- **MySQL** (banco de dados relacional)
- **barryvdh/laravel-dompdf** (exportação de PDF)
- **Bootstrap 5** (interface)
- **Chart.js** (gráfico no dashboard)

---

## Instalação e configuração

1. Clonar o repositório:

	```bash
	git clone https://github.com/Ladello/GestaoPETI.git
	cd GestaoPETI
	```

2. Instalar dependências PHP:

	```bash
	composer install
	```

3. Copiar arquivo `.env` e gerar chave da aplicação:

	```bash
	cp .env.example .env   # (no Windows: copy .env.example .env)
	php artisan key:generate
	```

4. Configurar banco de dados no `.env`:

	```env
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=gestao_peti
	DB_USERNAME=seu_usuario
	DB_PASSWORD=sua_senha
	```

5. Executar migrations:

	```bash
	php artisan migrate
	```

6. (Opcional, mas recomendado) Popular o sistema com dados de exemplo usando seeders:

	Isso cria um usuário admin e alguns registros de projetos, atividades, serviços, objetivos, metas, princípios, canvas e uploads de arquitetura, para você já enxergar o sistema funcionando com dados.

	```bash
	php artisan db:seed
	```

7. Criar link simbólico para o `storage` (para visualizar uploads e PDFs):

	```bash
	php artisan storage:link
	```

8. Subir o servidor de desenvolvimento:

	```bash
	php artisan serve
	```

8. Acessar no navegador:

	```text
	http://localhost:8000
	```

---

## Fluxo de uso sugerido

1. **Login** no sistema.
2. Acessar o **Dashboard** para ver a visão geral.
3. Cadastrar **Projetos** e suas **Atividades**.
4. Registrar **Serviços de TI** e relacionar seus resultados esperados.
5. Definir **Objetivos** e **Metas** estratégicas.
6. Cadastrar **Princípios de Arquitetura**.
7. Preencher o **Canvas de TI**.
8. Anexar artefatos de **Arquitetura** (diagramas, PDFs) e visualizá-los diretamente no sistema.

---

## Contribuição

Sugestões de melhoria, issues e pull requests são bem-vindos. 

---

## Licença

Este projeto é baseado em Laravel (licença MIT). Verifique o arquivo `LICENSE` do framework para mais detalhes.

