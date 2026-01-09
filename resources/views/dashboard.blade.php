<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div style="box-shadow: 0 4px 15px 0 rgba(79, 70, 229, 0.5), 0 6px 20px 0 rgba(147, 51, 234, 0.4), 0 0 30px rgba(79, 70, 229, 0.3); height: 180px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">

                <h2 class="text-lg text-gray-200 font-bold">deze week af:</h2>

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
                <h2 class="text-lg text-gray-200 font-bold">Openstaande taken</h2>

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
                <h2 class="text-lg text-gray-200 font-bold">Openstaande taken</h2>

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
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div style="height: 300px;"
                class="relative w-full overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700 lg:col-span-2 md:col-span-2 col-span-1">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div style="height: 300px;"
                class="relative overflow-hidden rounded-xl border p-5 border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
    </div>
</x-layouts.app>
