<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->session()->getId();
        $ip = $request->ip();
        $userAgent = $request->userAgent() ?? '';
        $device = $this->getDeviceType($userAgent);
        $browser = $this->getBrowser($userAgent);
        $os = $this->getOS($userAgent);

        // Update or create visitor
        DB::table('visitors')->updateOrInsert(
            ['session_id' => $sessionId],
            [
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'device' => $device,
                'browser' => $browser,
                'os' => $os,
                'last_activity' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Skip logging for admin/dashboard routes
        $routeName = $request->path();
        if (
            !Str::contains($routeName, [
                'dashboard',
                'admin',
                'login',
                'register',
                'password',
                'password/reset',
                'password/email',
                'password/confirm',
                'password/verify',
                'logout',
                'settings',
            ])
        ) {
            DB::table('route_visit_logs')->insert([
                'user_id' => auth()->id(),
                'route' => $routeName,
                'method' => $request->method(),
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'query_params' => json_encode($request->query()),
                'request_body' => json_encode($request->except(['_token', '_method'])),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }

    private function getDeviceType(string $userAgent): string
    {
        if (Str::contains($userAgent, ['iPhone', 'Android']))
            return 'Mobile';
        return 'Desktop';
    }

    private function getBrowser(string $userAgent): string
    {
        if (Str::contains($userAgent, 'Chrome'))
            return 'Chrome';
        if (Str::contains($userAgent, 'Firefox'))
            return 'Firefox';
        if (Str::contains($userAgent, 'Safari'))
            return 'Safari';
        return 'Other';
    }

    private function getOS(string $userAgent): string
    {
        if (Str::contains($userAgent, 'Windows'))
            return 'Windows';
        if (Str::contains($userAgent, 'Macintosh'))
            return 'MacOS';
        if (Str::contains($userAgent, 'Linux'))
            return 'Linux';
        if (Str::contains($userAgent, ['iPhone', 'iPad']))
            return 'iOS';
        if (Str::contains($userAgent, 'Android'))
            return 'Android';
        return 'Other';
    }
}
