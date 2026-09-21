@if (in_array($permission, [2, 3, 5], true))
    <div class="menu-header">ทะเบียนเอกสาร</div>
    @foreach ([
        ['route' => 'document_rdi.show', 'parameters' => [1], 'label' => 'หนังสือออก (ภายนอก)', 'icon' => 'fa-paper-plane'],
        ['route' => 'document_rdi.show', 'parameters' => [2], 'label' => 'หนังสือออก (ภายใน)', 'icon' => 'fa-file-lines'],
        ['route' => 'running.show', 'parameters' => [], 'label' => 'e-GP-Running', 'icon' => 'fa-list-ol'],
        ['route' => 'reference_naga.show', 'parameters' => [], 'label' => 'เลขอ้างอิง นากา', 'icon' => 'fa-hashtag'],
    ] as $registerMenu)
        @php
            $active = request()->routeIs($registerMenu['route'])
                && ($registerMenu['route'] !== 'document_rdi.show'
                    || (string) request()->route('id') === (string) $registerMenu['parameters'][0]);
        @endphp
        <div class="menu-item {{ $active ? 'active' : '' }}">
            <a href="{{ route($registerMenu['route'], $registerMenu['parameters']) }}" class="menu-link" @if ($active) aria-current="page" @endif>
                <div class="menu-icon"><i class="fas {{ $registerMenu['icon'] }}"></i></div>
                <div class="menu-text">{{ $registerMenu['label'] }}</div>
            </a>
        </div>
    @endforeach
@endif
