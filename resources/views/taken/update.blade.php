<x-layouts.app>
    <x-layouts.buttons.dashboardButton :title="__('Dashboard')" />


<!-- ik heb chatgpt gebruikt om de eerst voor de oude waardes te checken. anders moet ik veel code schrijven wat te veeel tijd kost.-->
    <form action="{{ route('taken.update', $taak->id) }}" method="POST" class="takenmakenform">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $taak->id }}">
        

        <label for="titel">Titel</label><br>
        <input type="text" id="title" name="titel" value="{{ old('titel', $taak->titel ?? '') }}" required><br>

        <label for="omschrijving">Omschrijving</label><br>
        <textarea id="omschrijving" name="omschrijving">{{ old('omschrijving', $taak->omschrijving ?? '') }}</textarea>

        <label for="deadline">Deadline</label><br>
        <small>je kan dit leeg laten als er geen deadline is</small><br>
        <input type="date" id="deadline" name="deadline" value="{{ old('deadline', isset($taak->deadline) ? (\Carbon\Carbon::parse($taak->deadline)->format('Y-m-d')) : '') }}"><br>

        <label for="categorie" class="form-label">Categorie</label>
        <select name="categorie" id="categorie" class="form-select" required>
            <option value="school" {{ (old('categorie', $taak->categorie ?? '') == 'school') ? 'selected' : '' }}>School</option>
            <option value="werk" {{ (old('categorie', $taak->categorie ?? '') == 'werk') ? 'selected' : '' }}>Werk</option>
            <option value="side-project" {{ (old('categorie', $taak->categorie ?? '') == 'side-project') ? 'selected' : '' }}>Side-Project</option>
            <option value="prive" {{ (old('categorie', $taak->categorie ?? '') == 'prive') ? 'selected' : '' }}>privé</option>
        </select>

        <label for="type" class="form-label">Type</label>
        <select name="type" id="type" class="form-select" required>
            <option value="anders" {{ (old('type', $taak->type ?? '') == 'anders') ? 'selected' : '' }}>Anders</option>
            <option value="backend" {{ (old('type', $taak->type ?? '') == 'backend') ? 'selected' : '' }}>Backend</option>
            <option value="frontend" {{ (old('type', $taak->type ?? '') == 'frontend') ? 'selected' : '' }}>Frontend</option>
            <option value="fullStack" {{ (old('type', $taak->type ?? '') == 'fullStack') ? 'selected' : '' }}>Full-Stack</option>
            <option value="API" {{ (old('type', $taak->type ?? '') == 'API') ? 'selected' : '' }}>API</option>
            <option value="AI" {{ (old('type', $taak->type ?? '') == 'AI') ? 'selected' : '' }}>AI</option>
            <option value="database" {{ (old('type', $taak->type ?? '') == 'database') ? 'selected' : '' }}>Database</option>
            <option value="devops" {{ (old('type', $taak->type ?? '') == 'devops') ? 'selected' : '' }}>DevOps</option>
            <option value="testing" {{ (old('type', $taak->type ?? '') == 'testing') ? 'selected' : '' }}>Testing</option>
            <option value="design" {{ (old('type', $taak->type ?? '') == 'design') ? 'selected' : '' }}>Design</option>
            <option value="documentation" {{ (old('type', $taak->type ?? '') == 'documentation') ? 'selected' : '' }}>Documentation</option>
        </select>

        <label for="prioriteit" class="form-label">Prioriteit</label>
        <select name="prioriteit" id="prioriteit" class="form-select" required>
            <option value="laag" {{ (old('prioriteit', $taak->prioriteit ?? '') == 'laag') ? 'selected' : '' }}>Laag</option>
            <option value="medium" {{ (old('prioriteit', $taak->prioriteit ?? '') == 'medium') ? 'selected' : '' }}>Medium</option>
            <option value="hoog" {{ (old('prioriteit', $taak->prioriteit ?? '') == 'hoog') ? 'selected' : '' }}>Hoog</option>
        </select>

        <button type="submit" class="btn btn-primary">Bijwerken</button>
    </form>
</x-layouts.app>