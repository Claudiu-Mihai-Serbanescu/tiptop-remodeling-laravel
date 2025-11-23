<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home()
    {
        // 1) Servicii (rămân ca până acum)
        $services = Service::orderBy('name')->limit(6)->get();

        // 2) Config Google (din config/services.php + .env)
        $placeId = (string) config('services.google.place_id');
        $apiKey  = (string) config('services.google.places_key');
        $hours   = (int)    config('services.google.reviews_cache_hours', 6);
        $maxRev  = (int)    config('services.google.reviews_max', 8); // Google livrează ~5; lăsăm 8 ca limită internă

        // 3) Citește din cache sau cheamă Place Details
        $payload = null;

        if ($placeId !== '' && $apiKey !== '') {
            $cacheKey = "gplace:details:{$placeId}";

            $payload = Cache::remember($cacheKey, now()->addHours($hours), function () use ($placeId, $apiKey) {
                try {
                    // Notă: includem 'photos' pentru thumbnail business și 'reviews' pentru lista de review-uri.
                    $res = Http::timeout(12)->get(
                        'https://maps.googleapis.com/maps/api/place/details/json',
                        [
                            'place_id'      => $placeId,
                            'fields'        => 'name,url,rating,user_ratings_total,reviews,photos',
                            'reviews_sort'  => 'newest',
                            'key'           => $apiKey,
                        ]
                    );

                    if (!$res->ok()) {
                        return null;
                    }

                    $result = $res->json('result');
                    if (!$result || !is_array($result)) {
                        return null;
                    }

                    // Construieste URL foto business (din photos[0].photo_reference) via Place Photo API
                    $bizPhoto = null;
                    if (!empty($result['photos'][0]['photo_reference'])) {
                        $ref = $result['photos'][0]['photo_reference'];
                        // folosim maxwidth 256 (mic, rapid)
                        $bizPhoto = sprintf(
                            'https://maps.googleapis.com/maps/api/place/photo?maxwidth=%d&photo_reference=%s&key=%s',
                            256,
                            urlencode($ref),
                            urlencode($apiKey)
                        );
                    }

                    // Normalizează reviews (avatar + link autor + text)
                    $reviews = [];
                    foreach (($result['reviews'] ?? []) as $r) {
                        $reviews[] = [
                            'author_name'               => $r['author_name'] ?? 'User',
                            'profile_photo_url'         => $r['profile_photo_url'] ?? null, // avatar autor, dacă există
                            'rating'                    => (int) ($r['rating'] ?? 5),
                            'relative_time_description' => $r['relative_time_description'] ?? '',
                            'text'                      => $r['text'] ?? '',
                            'author_url'                => $r['author_url'] ?? ($result['url'] ?? null),
                            'time'                      => $r['time'] ?? null,
                        ];
                    }

                    // Link direct „Write a review” (mai util pentru CTA)
                    $writeUrl = 'https://search.google.com/local/writereview?placeid=' . urlencode($placeId);

                    return [
                        'biz' => [
                            'name'        => $result['name']               ?? 'Tip Top Remodeling LLC',
                            'gmap'        => $result['url']                ?? 'https://maps.app.goo.gl/KnDmzyx72NjmbkUT9',
                            'rating'      => $result['rating']             ?? null,
                            'count'       => $result['user_ratings_total'] ?? null,
                            'photo'       => $bizPhoto, // poate fi null dacă nu există
                            'write_url'   => $writeUrl,
                        ],
                        'reviews' => $reviews,
                    ];
                } catch (\Throwable $e) {
                    // Poți loga $e->getMessage() în cazul în care vrei debug
                    return null;
                }
            });
        }

        // 4) Fallback sigur (dacă API-ul lipsește / a eșuat)
        $biz = [
            'name'      => $payload['biz']['name']      ?? 'Tip Top Remodeling LLC',
            'gmap'      => $payload['biz']['gmap']      ?? 'https://maps.app.goo.gl/KnDmzyx72NjmbkUT9',
            'rating'    => $payload['biz']['rating']    ?? null,
            'count'     => $payload['biz']['count']     ?? null,
            'photo'     => $payload['biz']['photo']     ?? asset('img/logo512.png'),
            'write_url' => $payload['biz']['write_url'] ?? 'https://maps.app.goo.gl/KnDmzyx72NjmbkUT9',
        ];

        $reviews = collect($payload['reviews'] ?? [])
            ->filter(fn($r) => !empty($r['text']))   // fără recenzii goale
            ->take($maxRev)
            ->values()
            ->all();

        return view('home', compact('services', 'biz', 'reviews'));
    }

    public function projects()
    {
        return view('projects.index');
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }
}
