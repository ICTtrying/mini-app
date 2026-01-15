<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if($succesBericht)
            <div class="text-center bg-green-700 border-white-500 font-bold px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ $succesBericht }}</span>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alertBox = document.querySelector('[role="alert"]');
                    if (alertBox) {
                        setTimeout(() => {
                            alertBox.style.display = 'none';
                        }, 1500);
                    }
                });
            </script>
        @endif
        @if(session('succesBerichtTaak'))
            <div class="text-center bg-green-700 border-white-500 font-bold px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('succesBerichtTaak') }}</span>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alertBox = document.querySelector('[role="alert"]');
                    if (alertBox) {
                        setTimeout(() => {
                            alertBox.style.display = 'none';
                        }, 4000);
                    }
                });
            </script>
        @endif
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div style="box-shadow: 0 4px 15px 0 rgba(79, 70, 229, 0.5), 0 6px 20px 0 rgba(147, 51, 234, 0.4), 0 0 30px rgba(79, 70, 229, 0.3); height: 180px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">

                <h2 class="text-lg text-gray-500 dark:text-gray-100 font-bold">deze week af:</h2>

                <p style="font-weight: bolder; font-size: 25px; margin-top: 10px;"><span
                        style="margin-right: 15px; font-size: 30px; color: {{ $klaarWeekCount == 0 ? 'rgb(255, 8, 8)' : 'rgb(37, 255, 8)' }}">{{ $klaarWeekCount }}</span>
                    <span> Klaar!</span>
                </p>
                <br>

                @if (empty($klaarWeekCount))
                    <span style="font-weight: bold; font-size: 20px; color: rgb(255, 165, 0)">Nog geen taken
                        klaar.</span>
                @else
                    <span
                        style="font-weight: bold; font-size: 20px; color: {{ $gekozenKleur }}">{{ $gekozenBericht }}</span>
                @endif
            </div>

            <div style="box-shadow: 0 4px 15px 0 rgba(79, 70, 229, 0.5), 0 6px 20px 0 rgba(147, 51, 234, 0.4), 0 0 30px rgba(79, 70, 229, 0.3); height: 180px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">
                <h2 class="text-lg text-gray-500 dark:text-gray-100 font-bold">Openstaande taken</h2>

                <p style="font-weight: bolder; font-size: 25px; margin-top: 10px;"><span
                        style="margin-right: 15px; font-size: 30px; color: {{ $nietKlaarCount > 5 ? 'rgb(255, 8, 8)' : ($nietKlaarCount >= 1 ? 'rgb(255, 165, 0)' : 'rgb(37, 255, 8)') }}">{{ $nietKlaarCount }}</span>
                    <span> Taken</span>
                </p>
                <br>

                @if ($nietKlaarCount > 5)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(255, 8, 8);">Je bent nog niet klaar. Aan
                        de slag!</span>
                @elseif ($nietKlaarCount >= 1)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(255, 165, 0);">Hou vol. bijna
                        klaar!</span>
                @else
                    <span style="font-weight: bold; font-size: 20px; color: rgb(0, 255, 0);">Alles in orde!</span>
                @endif
            </div>

            <div style="box-shadow: 0 4px 15px 0 rgba(79, 70, 229, 0.5), 0 6px 20px 0 rgba(147, 51, 234, 0.4), 0 0 30px rgba(79, 70, 229, 0.3); height: 180px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">
                <h2 class="text-lg text-gray-500 dark:text-gray-100 font-bold">Percentage voltooid:</h2>

                <p style="font-weight: bolder; font-size: 25px; margin-top: 10px;"><span
                        style="margin-right: 15px; font-size: 30px;">{{ $procentKlaar }}% </span>
                    <span> gedaan!</span>
                </p>
                <br>

                @if ($procentKlaar < 25)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(255, 8, 8);">Laten we beginnen!</span>
                @elseif ($procentKlaar < 50)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(255, 165, 0);">Goed bezig! Je bent al op
                        weg!</span>
                @elseif ($procentKlaar == 50)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(204, 0, 255);">Je bent op de
                        helft!</span>
                @elseif ($procentKlaar < 75)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(204, 0, 255);">Je bent over de helft, ga
                        zo door!</span>
                @elseif ($procentKlaar < 100)
                    <span style="font-weight: bold; font-size: 20px; color: rgb(0, 255, 127);">Bijna klaar! Nog een
                        klein stukje!</span>
                @else
                    <span style="font-weight: bold; font-size: 20px; color: rgb(0, 255, 0);">Alles voltooid, geweldig
                        gedaan!</span>
                @endif

            </div>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div id="dashboardTaskViewContainer" class="bg-zinc-300 dark:bg-zinc-600 lg:col-span-2 md:col-span-2 col-span-1">
                <h2>
                    overzicht over uw taken voor de week:
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



            <div style="height: 300px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">

            </div>
        </div>
    </div>
</x-layouts.app>
