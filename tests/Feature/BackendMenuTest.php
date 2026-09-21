<?php

namespace Tests\Feature;

use Tests\TestCase;

class BackendMenuTest extends TestCase
{
    public function test_menu_visibility_matches_permissions_for_current_and_legacy_sessions(): void
    {
        foreach (['permission', 'permisstion'] as $key) {
            foreach ([0, 1, 2, 3, 4, 5, 6, 99] as $permission) {
                session()->flush();
                session()->put('user', [$key => (string) $permission]);
                session()->put('main-menu.main_menu_all', []);

                $html = view('backend.menu.show_menu')->render();

                $this->assertSame(in_array($permission, [1, 2, 4, 5]), str_contains($html, 'Content Menu'));
                $this->assertSame(in_array($permission, [1, 2, 4, 5]), str_contains($html, 'Office Menu'));
                $this->assertSame(in_array($permission, [1, 2, 4, 5]), str_contains($html, route('quality.index')));
                $this->assertSame(in_array($permission, [1, 2, 4, 5]), str_contains($html, route('document.setting', 'qualities')));
                $this->assertSame(in_array($permission, [2, 4, 5]), str_contains($html, route('member.index')));
                $this->assertSame($permission === 5, str_contains($html, 'Dev Menu'));
                foreach ([route('document_rdi.show', 1), route('document_rdi.show', 2), route('running.show'), route('reference_naga.show')] as $url) {
                    $this->assertSame(in_array($permission, [2, 3, 5]), str_contains($html, $url));
                }
            }
        }
    }

    public function test_missing_session_does_not_show_privileged_menus(): void
    {
        session()->flush();

        $html = view('backend.menu.show_menu')->render();

        $this->assertStringNotContainsString('Office Menu', $html);
        $this->assertStringNotContainsString('Dev Menu', $html);
        $this->assertStringNotContainsString(route('member.index'), $html);
    }

    public function test_current_permission_takes_precedence_over_legacy_permission(): void
    {
        session()->put('user', ['permission' => 1, 'permisstion' => 5]);

        $html = view('backend.menu.show_menu')->render();

        $this->assertStringContainsString('Office Menu', $html);
        $this->assertStringNotContainsString('Dev Menu', $html);
        $this->assertStringNotContainsString(route('member.index'), $html);
    }

    public function test_legacy_quality_setting_url_redirects_to_shared_document_settings(): void
    {
        $this->get('/setting_document/s')
            ->assertRedirect('/document/settings/qualities');
        $this->get('/document/settings/report')
            ->assertRedirect('/document/settings/qualities');
    }
}
