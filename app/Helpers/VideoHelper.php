<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Analiza la IP/URL y devuelve los datos necesarios para el reproductor.
     */
    public static function parseUrl(string $url): array
    {
        $url = trim($url);
        $isYoutube = false;
        $streamUrl = '';

        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            $isYoutube = true;
            // Extraer ID del video con regex
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            $videoId = $match[1] ?? null;
            // URL embed optimizada para autoplay y sin controles
            $streamUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&controls=0&disablekb=1&modestbranding=1&rel=0&loop=1&playlist={$videoId}";
        } elseif (str_starts_with($url, 'http')) {
            // Es una URL completa (ej: http://192.168.1.50:8080/video)
            $streamUrl = $url;
        } elseif (str_contains($url, ':')) {
            // Es IP:PUERTO (Asumimos que necesita /video al final, común en apps de celular)
            $streamUrl = "http://{$url}/video";
        } else {
            // Es solo IP (Asumimos puerto estándar 81 y ruta /stream para ESP32 o similar)
            $streamUrl = "http://{$url}:81/stream";
        }

        return [
            'isYoutube' => $isYoutube,
            'streamUrl' => $streamUrl,
        ];
    }
}