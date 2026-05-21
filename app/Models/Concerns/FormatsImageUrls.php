<?php

namespace App\Models\Concerns;

trait FormatsImageUrls
{
	public function getImageUrlAttribute($value)
	{
		if (!$value || strpos($value, '/images/') !== 0) {
			return $value;
		}

		return rtrim(config('app.url'), '/') . $value;
	}
}
