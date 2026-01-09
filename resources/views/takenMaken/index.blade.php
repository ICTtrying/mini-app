<x-layouts.app>
    <x-layouts.buttons.dashboardButton :title="__('Dashboard')" />

    <form action="{{ route('dashboard') }}" method="POST" class="takenmakenform">
        @csrf
        
        <div class="form-group mb-3">
            <label for="title" class="form-label">Titel <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="omschrijving" class="form-label">Omschrijving</label>
            <textarea name="omschrijving" id="omschrijving" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="deadline" class="form-label">Deadline <span class="text-danger">*</span></label>
            <input type="datetime-local" name="deadline" id="deadline" class="form-control" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-select">
                        <option value="anders" selected>Anders</option>
                        <option value="backend">Backend</option>
                        <option value="frontend">Frontend</option>
                        <option value="API">API</option>
                        <option value="AI">AI</option>
                        <option value="database">Database</option>
                        <option value="devops">DevOps</option>
                        <option value="testing">Testing</option>
                        <option value="design">Design</option>
                        <option value="documentation">Documentation</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="prioriteit" class="form-label">Prioriteit</label>
                    <select name="prioriteit" id="prioriteit" class="form-select">
                        <option value="laag">Laag</option>
                        <option value="medium" selected>Medium</option>
                        <option value="hoog">Hoog</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </div>
    </form>
</x-layouts.app>
