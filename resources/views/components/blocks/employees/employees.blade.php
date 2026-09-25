@php
    use Shazzoo\Employees\Models\Employee;

    $limit = $data['limit'] ?? 'all';
    $background = $data['background'] ?? 'white';
    $nodeLabel = filled($data['label'] ?? null)
        ? (($node ?? null) ? 'NODE '.str_pad((string) $node, 2, '0', STR_PAD_LEFT).' · '.$data['label'] : $data['label'])
        : null;
    $employees = Employee::query()
        ->with('image')
        ->forLocale()
        ->orderBy('name')
        ->when($limit !== 'all', fn ($query) => $query->limit((int) $limit))
        ->get();
@endphp

<section @class([
    'cs-sec',
    'cs-sec--white' => $background !== 'ground' && $background !== 'dark',
    'cs-sec--ground' => $background === 'ground',
    'cs-sec--dark' => $background === 'dark',
])>
    <div class="cs-col cs-sec__inner">
        @if ($nodeLabel)
            <div class="cs-node">
                <span class="cs-label">{{ $nodeLabel }}</span>
            </div>
        @endif

        <div @class(['mt-3' => (bool) $nodeLabel])>
            @if (filled($data['title'] ?? null))
                <h2 class="cs-h2">{{ $data['title'] }}</h2>
            @endif

            <div class="mt-[26px] grid grid-cols-1 border-l border-t border-hairline sm:grid-cols-2 lg:grid-cols-5">
                @forelse ($employees as $employee)
                    <div class="border-b border-r border-hairline px-5 py-6 text-center">
                        @if ($employee->image)
                            <img src="{{ $employee->image->url }}" alt="{{ $employee->name }}"
                                class="mx-auto h-[86px] w-[86px] rounded-full object-cover">
                        @else
                            <div class="mx-auto h-[86px] w-[86px] rounded-full border border-hairline bg-ground"></div>
                        @endif

                        <div>
                            <p class="mt-4 font-display text-[15px] font-bold text-heading">{{ $employee->name }}</p>
                            <p class="mt-0.5 text-[14px] text-body">{{ $employee->role }}</p>
                        </div>

                        @if (filled($employee->skills))
                            <p class="cs-spec mt-3">{{ implode(' · ', $employee->skills) }}</p>
                        @endif
                    </div>
                @empty
                    <div class="border-b border-r border-hairline px-5 py-6 text-center sm:col-span-2 lg:col-span-5">
                        <p class="text-[14px] text-muted">No employees have been added yet.</p>
                    </div>
                @endforelse
            </div>

            @if (filled($data['note'] ?? null))
                <p class="mt-6 border-l-2 border-hairline pl-5 text-[14px] leading-relaxed text-muted">{{ $data['note'] }}</p>
            @endif
        </div>
    </div>
</section>
