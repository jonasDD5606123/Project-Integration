<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecompressRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->get('Content-Encoding') === 'gzip') {
            // Decompress the body
            $content = gzdecode($request->getContent());

            // Log the decompressed content for debugging

            if ($content === false) {
                // Handle decompression failure
                return response()->json(['error' => 'Decompression failed'], 400);
            }

            // Replace the request's body with decompressed content
            // Assuming JSON content
            $request->replace(json_decode($content, true));
        }

        // Continue the request lifecycle
        return $next($request);
    }
}
