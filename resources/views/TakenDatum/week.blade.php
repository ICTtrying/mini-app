<x-layouts.app :title="__('Vandaag')">
<div id="dashboardTaskViewContainer" style="height: 500px; margin-bottom: 0;">
                <h2>
                    overzicht over uw taken voor vandaag:
                </h2>
                <form action="{{ route('checkTaak') }}">
                    @csrf

                    @foreach ($taken as $taak)
                        <form action="{{ route('checkTaak') }}" method="POST" class="taak-form">
                            @csrf
                            <input type="hidden" name="taak_id" value="{{ $taak->id }}">

                            <div @class(["taak-container", $taak->status === 'klaar' ? 'niet-klaar' : 'niet klaar'])>
                                <input type="checkbox" class="checkbox" onchange="this.form.submit()"
                                    {{ $taak->status === 'klaar' ? 'checked' : '' }}>

                                <span class="titel">{{ $taak->titel }}</span>
                                <span class="type">{{ $taak->type }}</span><br>

                                @if ($taak->omschrijving)
                                    <small class="omschrijving">{{ $taak->omschrijving }}</small>
                                @endif

                                @if ($taak->deadline)
                                    <span class="deadline">{{ $taak->deadline }}</span>
                                @endif
                            </div>
                        </form>
                    @endforeach

                </form>
            </div>
</x-layouts.app>