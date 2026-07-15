<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AreaImageController extends Controller
{
    public function destroy(
        AreaImage $areaImage
    ): RedirectResponse {
        Storage::disk('public')
            ->delete($areaImage->image_path);

        $areaImage->delete();

        return back()->with(
            'success',
            'Gallery image deleted successfully.'
        );
    }
}