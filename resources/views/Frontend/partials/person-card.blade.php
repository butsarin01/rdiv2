<div class="col-xl-3 col-lg-4 col-md-6">
    <article class="person-card">
        <img class="person-photo" src="{{ $person->show_image() }}"
            alt="{{ trim($person->prefix().' '.$person->name.' '.$person->lastname) }}" loading="lazy">
        <div class="person-body">
            <h3 class="person-name">{{ trim($person->prefix().' '.$person->name.' '.$person->lastname) }}</h3>
            <div class="person-position">{{ $person->position() }}</div>
            <div class="person-contact">
                @if (!empty($person->telephone))
                    <span><i class="bi bi-telephone"></i>{{ $person->telephone }}</span>
                @endif
                @if (!empty($person->email))
                    <a href="mailto:{{ $person->email }}"><i class="bi bi-envelope"></i>{{ $person->email }}</a>
                @endif
                @if (!empty($person->position_self))
                    <span><i class="bi bi-person-badge"></i>{{ $person->position_self }}</span>
                @endif
            </div>
            @if (!empty($person->ldep_username))
                <a class="person-profile"
                    href="https://www.nsru.ac.th/personal_info/index.php?ldap={{ urlencode($person->ldep_username) }}"
                    target="_blank" rel="noopener">
                    ดูข้อมูลเพิ่มเติม <i class="bi bi-arrow-up-right"></i>
                </a>
            @endif
        </div>
    </article>
</div>
