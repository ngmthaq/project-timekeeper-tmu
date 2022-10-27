<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use stdClass;

class ShareLocaleWithView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $langs = array_diff(scandir(resource_path('lang')), array('.', '..'));
        $translationJsons = collect();
        $translations = collect();

        foreach ($langs as $lang) {
            $info = pathinfo(resource_path('lang/' . $lang));
            if (isset($info['extension']) && $info['extension'] === 'json') {
                $key = $info['filename'];
                $translationJsons->put($key, json_decode(File::get(resource_path('lang/' . $lang))));
            } else {
                $transFolder = collect(File::allFiles(resource_path('lang' . DIRECTORY_SEPARATOR . $lang)))
                    ->flatMap(function ($file) {
                        return collect([$file->getBasename('.php') => include($file->getPathname())]);
                    });

                $translations->put($lang, $transFolder);
            }
        }

        View::share('translationJsons', $translationJsons);
        View::share('translations', $translations);
        View::share('fallbackLocale', config('app.fallback_locale'));
        View::share('locales', json_encode(config('locales')));

        return $next($request);
    }
}
