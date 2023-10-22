<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Core\Entities\Domain;
use Modules\Core\Entities\Language;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('locale')) {
            App::setLocale($request->session()->get('locale'));
        }

        // Récupération des domaines de l'administrateur
        if (!empty(Auth::guard('admin')->user())) {
            $domains = Auth::guard('admin')->user()->domains;

            // Récupération du domaine courant
            $current_domain = Domain::find($request->session()->get('domain'));
            $current_domain_languages = $current_domain->languages->map(function($language) {
                return $language->language_id;
            });

            // Récupération des langues du domaine courant
            $languages = Language::whereIn('id', $current_domain_languages)->get();

            // Récupération de la langue courante
            $current_language = Language::firstWhere('alpha2', App::getLocale());

            // Si la langue courante n'est pas dans la liste des langues du domaine courant
            if (!in_array($current_language->id, $current_domain_languages->all())) {
                $request->session()->put('locale', $current_domain->languages->first()->language->alpha2);
                $current_language = $current_domain->languages->first()->language;
                App::setLocale($request->session()->get('locale'));
            }

            $request->session()->put('domains', $domains);
            $request->session()->put('languages', $languages);

            View::share('domains', $domains);
            View::share('languages', $languages);
            View::share('current_language', $current_language);
            View::share('current_domain', $current_domain);
        }

        return $next($request);
    }
}
