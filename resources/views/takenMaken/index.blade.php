<x-layouts.app>
    <x-layouts.buttons.dashboardButton :title="__('Dashboard')" />

    <form action="{{ route('taken.create') }}" method="POST" class="takenmakenform">
        @csrf

        <label for="titel">Titel</label><br>
        <input type="text" id="title" name="titel" required><br>

        <label for="omschrijving">Omschrijving</label><br>
        <textarea id="omschrijving" name="omschrijving"></textarea>

        <label for="deadline">Deadline</label><br>
        <small>je kan dit leeg laten als er geen deadline is</small><br>
        <input type="date" id="deadline" name="deadline"><br>

        <label for="categorie" class="form-label">Categorie</label>
        <select name="categorie" id="categorie" class="form-select" required>
            <option value="school" selected>School</option>
            <option value="werk">Werk</option>
            <option value="side-project">Side-Project</option>
            <option value="prive">privé</option>
        </select>

        <label for="type" class="form-label">Type</label>
        <select name="type" id="type" class="form-select" required>
            <option value="anders" selected>Anders</option>
            <option value="backend">Backend</option>
            <option value="frontend">Frontend</option>
            <option value="fullStack">Full-Stack</option>
            <option value="API">API</option>
            <option value="AI">AI</option>
            <option value="database">Database</option>
            <option value="devops">DevOps</option>
            <option value="testing">Testing</option>
            <option value="design">Design</option>
            <option value="documentation">Documentation</option>
        </select>

        <label for="prioriteit" class="form-label">Prioriteit</label>
        <select name="prioriteit" id="prioriteit" class="form-select" required>
            <option value="laag">Laag</option>
            <option value="medium" selected>Medium</option>
            <option value="hoog">Hoog</option>
        </select>

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</x-layouts.app>
