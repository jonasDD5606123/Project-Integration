<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the client accepts gzip compression
        if (strpos($request->header('Accept-Encoding'), 'gzip') !== false) {
            // Compress the response content using GZIP
            $compressedContent = gzencode($response->getContent(), 9); // Level 9 for maximum compression

            // Update the response content to the compressed version
            $response->setContent($compressedContent);

            // Set the Content-Encoding header to gzip
            $response->headers->set('Content-Encoding', 'gzip');
        }

        return $response;
    }
}
