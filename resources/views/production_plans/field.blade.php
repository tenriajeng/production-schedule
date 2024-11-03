<h3 class="text-lg font-semibold mt-6">Production Schedule</h3>
<div class="mb-4">
    <label for="production_name" class="block text-sm font-medium text-gray-700">Production Name</label>
    <input type="text" id="production_name" name="name" value="{{ old('name', $productionPlan->name ?? '') }}"
        class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror"
        placeholder="Enter production name">
    @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<h3 class="text-lg font-semibold mt-6">Production Schedule (7 Days)</h3>
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-7 gap-2">
    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
        <div class="mb-2">
            <label for="planned_production_{{ $day }}" class="block text-sm font-medium text-gray-700">
                Planned for {{ ucfirst($day) }}
            </label>
            <input type="number" id="planned_production_{{ $day }}"
                name="planned_production[{{ $day }}]"
                value="{{ old('planned_production.' . $day, isset($productionPlan) ? $productionPlan->productionSchedules->firstWhere('day', $day)->planned_production : '') }}"
                class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200 @error('planned_production.' . $day) border-red-500 @enderror"
                placeholder="Enter planned production for {{ ucfirst($day) }}">
            @error('planned_production.' . $day)
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-7 gap-2">
    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
        <div class="mb-2">
            <label for="adjusted_production_{{ $day }}" class="block text-sm font-medium text-gray-700">
                Adjusted for {{ ucfirst($day) }}
            </label>
            <input type="number" id="adjusted_production_{{ $day }}"
                name="adjusted_production[{{ $day }}]"
                value="{{ old('adjusted_production.' . $day, isset($productionPlan) ? $productionPlan->productionSchedules->firstWhere('day', $day)->adjusted_production : 0) }}"
                readonly
                class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200 @error('adjusted_production.' . $day) border-red-500 @enderror"
                placeholder="Adjusted production for {{ ucfirst($day) }}">
            @error('adjusted_production.' . $day)
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>

<div class="mt-4">
    <h4 class="text-lg font-semibold">Total Planned Production: <span id="total_production">0</span>
    </h4>
</div>

<div class="flex justify-end mt-4 gap-2">
    <a href="{{ route('production.plans.index') }}"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-md text-sm px-5 py-2 me-2 mb-2">
        Back
    </a>
    <button type="button" onclick="adjustProduction()"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-md text-sm px-5 py-2 me-2 mb-2">
        Adjust Production
    </button>
    <button type="submit"
        class=" text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2">
        Save
    </button>
</div>

<script>
    function adjustProduction() {
        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        const plannedProductions = days.map(day => {
            return parseInt(document.getElementById(`planned_production_${day}`).value) || 0;
        });

        const totalProduction = plannedProductions.reduce((sum, num) => sum + num, 0);

        document.getElementById('total_production').innerText = totalProduction;

        const averageProduction = Math.floor(totalProduction / days.length);
        let remainder = totalProduction % days.length;

        let adjustedProductions = new Array(days.length).fill(averageProduction);

        plannedProductions.forEach((planned, index) => {
            if (planned === 0) {
                adjustedProductions[index] = 0;
            }
        });

        const nonZeroDays = plannedProductions
            .map((planned, index) => planned > 0 ? index : -1)
            .filter(index => index !== -1);

        const nonZeroCount = nonZeroDays.length;

        if (nonZeroCount > 0) {
            const nonZeroTotal = nonZeroDays.reduce((sum, index) => sum + plannedProductions[index], 0);
            const nonZeroAverage = Math.floor(nonZeroTotal / nonZeroCount);
            remainder = nonZeroTotal % nonZeroCount;

            adjustedProductions = adjustedProductions.map((prod, index) =>
                nonZeroDays.includes(index) ? nonZeroAverage : 0
            );

            const sortedIndices = [...nonZeroDays].sort((a, b) => plannedProductions[b] - plannedProductions[a]);

            sortedIndices.forEach(index => {
                if (remainder > 0) {
                    adjustedProductions[index] += 1;
                    remainder--;
                }
            });
        }

        days.forEach((day, index) => {
            document.getElementById(`adjusted_production_${day}`).value = adjustedProductions[index];
        });
    }
</script>
