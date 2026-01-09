<x-layouts.app>
    <x-layouts.buttons.dashboardButton :title="__('Dashboard')" />

    <form action="{{ route('dashboard') }}" method="POST" class="takenmakenform">
        @csrf
        
        <div class="form-group">
            <label for="title">{{ __('Titel') }}</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">{{ __('Beschrijving') }}</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Opslaan') }}</button>
        </div>
    </form>
</x-layouts.app>
