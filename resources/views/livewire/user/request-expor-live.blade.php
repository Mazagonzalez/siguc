<div class="p-8 card-theme">
    {{-- Filtro --}}
    <div x-data="{ showFilter: false }" class="p-4 rounded-lg cursor-pointer bg-zinc-100 dark:bg-[#252525] my-5">
        <div class="items-center justify-between row" @click="showFilter = !showFilter">
            <button class="items-center gap-1 row">
                <span class="text-sm">Filtrar</span>
                <x-icons.arrow class="stroke-black dark:stroke-white size-4" />
            </button>
        </div>

        <div
            x-ref="container"
            class="gap-4 overflow-hidden transition-all duration-300 col max-h-0"
            x-bind:style="showFilter == true ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''"
        >
            <div class="col">
                <div class="items-end gap-2 px-2 mt-6 row">
                    <div class="w-1/3">
                        <p class="title-input">Fecha inicial:</p>
                        <input class="w-full input-simple" type="date"/>
                    </div>

                    <div class="w-1/3">
                        <p class="title-input">Fecha final:</p>
                        <input class="w-full input-simple" type="date" />
                    </div>

                    <div class="w-1/3">
                        <p class="title-input">Estado:</p>
                        <select class="w-full input-simple">
                            <option value="0">Selecciona</option>
                            <option value="1">Pendiente</option>
                            <option value="2">Aceptado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="justify-end gap-2 px-2 row">
                <button class="items-center gap-2 btn-close-modal row">
                    <x-icons.clear class="stroke-slate-900 dark:stroke-white size-5" />

                    <span>
                        Limpiar
                    </span>
                </button>
            </div>
        </div>
    </div>

    <table class="w-full">
        <thead>
            <tr class="tr">
                <th class="th">Estado</th>
                <th class="th">Numero de orden</th>
                <th class="th">Fecha de entrega</th>
                <th class="th">Fecha de confirmacion</th>
                <th class="th">Tiempo de respuesta</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <p class="py-20 text-center">No tienes solicitudes en proceso</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

