<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AreaImageController extends Controller
{
    public function destroy(
        AreaImage $areaImage
    ): RedirectResponse {
        try {
            Storage::disk('uploads')->delete(
                $areaImage->image_path
            );

            $areaImage->delete();

            return back()->with(
                'success',
                'Photo deleted successfully.'
            );
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'error' => $exception->getMessage(),
            ]);
        }
    }
}